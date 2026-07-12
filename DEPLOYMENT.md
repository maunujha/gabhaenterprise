# DEPLOYMENT.md — Gabha Enterprise

Production deployment guide. Local dev → GitHub → **automatic** deploy to the VPS.

> ⚠️ **Shared VPS.** This server also hosts **Urbanflaky**, a separate production
> app. Every command here is scoped to `/var/www/gabhaenterprise` and never
> restarts shared services (nginx, php8.3-fpm). Do not run global/server-level
> changes as part of a deploy. See `CLAUDE.md` → *Shared-VPS safety*.

---

## 1. Deployment architecture

- **Model:** in-place git deploy. The server working tree at
  `/var/www/gabhaenterprise` is reset hard to `origin/main` on every deploy —
  the tree is disposable, GitHub `main` is the single source of truth.
- **No release directories / symlink swap.** See
  [§7 Rollback](#7-rollback) for *why* and what we use instead.
- **Runner:** GitHub Actions (GitHub-hosted `ubuntu-latest`) runs pre-deploy
  checks, then SSHes into the VPS and executes `deploy/deploy.sh`.
- **Server runtime:** PHP 8.3-FPM (shared socket `/run/php/php8.3-fpm.sock`),
  own nginx vhost, own MySQL DB. Session / cache / queue all use the **database**
  driver.

### Files that make up the pipeline

| File | Purpose |
|---|---|
| `.github/workflows/deploy.yml` | CI/CD: quality gate + SSH deploy + external health check |
| `deploy/deploy.sh` | The deploy script that runs **on the server** (idempotent, self-rolling-back) |
| `deploy/rollback.sh` | Manual rollback to a previous commit |
| `deploy/nginx/gabhaenterprise.conf` | nginx vhost (installed once, not part of auto-deploy) |

---

## 2. Deployment flow

```
Feature branch
      ↓  (open PR)
   development
      ↓  Pull Request → code review → approve
   merge to  main
      ↓  push event
GitHub Actions (.github/workflows/deploy.yml)
      ├─ job: quality  (composer validate · php -l · config validation · tests · Pint*)
      ↓  (only if quality passes)
      └─ job: deploy   → SSH into VPS → bash deploy/deploy.sh
                              ├─ maintenance on
                              ├─ git reset --hard origin/main
                              ├─ composer install --no-dev
                              ├─ npm ci && npm run build
                              ├─ migrate --force
                              ├─ storage:link (idempotent)
                              ├─ rebuild caches (config/route/view)
                              ├─ queue:restart
                              ├─ maintenance off
                              └─ health checks  ─(fail)→ auto-rollback
      ↓
External HTTP 200 check from the runner
      ↓
Production updated ✅
```

> The integration branch on this repo is named **`development`** (not `dev`).
> The workflow triggers on **`main`** regardless of where the merge came from.

---

## 3. GitHub Secrets

Configure under **Repo → Settings → Secrets and variables → Actions → New repository secret**.

| Secret | Required | Example | Notes |
|---|---|---|---|
| `SERVER_HOST` | ✅ | `203.0.113.10` | VPS IP or hostname |
| `SERVER_USER` | ✅ | `deploy` | The non-root deploy user that owns `/var/www/gabhaenterprise` |
| `SERVER_SSH_KEY` | ✅ | *(PEM private key)* | **Private** key whose public half is in the deploy user's `~/.ssh/authorized_keys`. Paste the whole key including header/footer lines. |
| `SERVER_PORT` | ⬜ | `22` | SSH port. Omit to default to `22`. |
| `SERVER_APP_DIR` | ⬜ | `/var/www/gabhaenterprise` | Project root. Omit to use the script default. |
| `HEALTHCHECK_URL` | ⬜ | `https://gabhaenterprise.com` | URL for the post-deploy HTTP 200 check. Defaults to `https://gabhaenterprise.com`. |

### Generating a dedicated deploy key (recommended — do NOT reuse a personal key)

On the server (or locally), create a key **just for CI**:

```bash
ssh-keygen -t ed25519 -C "github-actions-gabha" -f gabha_deploy -N ""
```

- Append `gabha_deploy.pub` to the deploy user's `~/.ssh/authorized_keys` on the VPS.
- Put the **private** key `gabha_deploy` into the `SERVER_SSH_KEY` secret.
- Restrict it if you like (in `authorized_keys`): `from="<gh-ip>",no-agent-forwarding,no-port-forwarding …`
  (optional — GitHub runners use dynamic IPs, so `from=` is impractical; prefer a
  dedicated low-privilege `deploy` user instead).

---

## 4. One-time server setup (before the first auto-deploy)

The workflow assumes the repo is already cloned and runnable on the server. Do
this **once**, manually, as the `deploy` user:

```bash
cd /var/www
git clone https://github.com/maunujha/gabhaenterprise.git
cd gabhaenterprise
git checkout main

cp .env.example .env
php artisan key:generate            # sets APP_KEY (never commit .env)
# ...edit .env: APP_ENV=production, APP_DEBUG=false, APP_URL, DB_*, MAIL_*, INQUIRY_MAIL_TO...

composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan storage:link            # harmless even though the app doesn't use the public disk

chmod -R ug+rwX storage bootstrap/cache
```

- Ensure `git`, `php8.3`, `composer`, and `node`/`npm` are on the deploy user's PATH.
- Ensure the deploy user can run `deploy/deploy.sh` non-interactively over SSH.
- Install the nginx vhost + TLS once (see `deploy/nginx/gabhaenterprise.conf` and
  `deployment.md`). These are **not** part of the automated deploy.

After this, every merge to `main` deploys automatically.

---

## 5. Deployment commands

```bash
# Automatic — nothing to run; merging a PR into main triggers the workflow.

# Manual full deploy (on the server, as deploy user):
bash deploy/deploy.sh

# Manual deploy of a non-default branch or dir (env overrides):
APP_DIR=/var/www/gabhaenterprise BRANCH=main bash deploy/deploy.sh

# Manually re-run the pipeline without a new commit:
#   GitHub → Actions → "Deploy (production)" → Run workflow (workflow_dispatch)
```

---

## 6. Pre-deploy checks (the `quality` job)

Runs on every push to `main`; **deploy is skipped if any blocking check fails**.

| Check | Blocking? | Command |
|---|---|---|
| PHP version | ✅ | `php -v` (pinned to 8.3) |
| Composer manifest | ✅ | `composer validate --strict` |
| Dependency install | ✅ | `composer install` |
| PHP syntax | ✅ | `php -l` across `app config database routes tests` |
| Laravel config compiles | ✅ | `php artisan config:cache` |
| Tests | ✅ | `php artisan test` (PHPUnit; uses `phpunit.xml` sqlite/array drivers) |
| Code style (Pint) | ⚠️ advisory | `vendor/bin/pint --test` (`continue-on-error`) |

**Why Pint is advisory:** the existing codebase is not yet Pint-clean (6 files).
Making it blocking would stop every deploy over cosmetic issues. To make it a
hard gate later: run `vendor/bin/pint` to format, commit, then remove
`continue-on-error: true` from the workflow. PHPStan is **not** installed and is
intentionally not added.

---

## 7. Rollback

### Why no atomic release-directory deploy?

This app uses an **in-place git working tree** (`git reset --hard origin/main`),
not timestamped `releases/` with a `current` symlink. Introducing symlink
releases would change the server layout, the nginx `root`, and the `.env`/storage
sharing model — a larger migration than this task warrants for a small marketing
site with fast, cached deploys. Instead we get safety two ways:

1. **Automatic code rollback on failure.** `deploy/deploy.sh` records the current
   commit (`PREV_SHA`) before it resets. If any step — including the health
   checks — fails, it resets the tree back to `PREV_SHA`, rebuilds
   dependencies/caches, and brings the app out of maintenance mode. The
   repository is **never left half-updated**.
2. **Manual rollback** to any earlier commit:

   ```bash
   bash deploy/rollback.sh              # previous commit (HEAD~1)
   bash deploy/rollback.sh <commit-sha> # a specific commit
   ```

### ⚠️ Migrations are not auto-reverted

Auto-running `migrate:rollback` is unsafe (a `down()` can drop columns/data).
Both scripts roll back **code only** and print a reminder. If a bad migration is
involved:

- Prefer restoring the DB from backup, **or**
- Run the specific `php artisan migrate:rollback --step=1 --force` yourself after
  confirming the `down()` is safe.

Always keep a DB backup/snapshot before deploys that include migrations.

---

## 8. Health checks

Run automatically at the end of every deploy; a critical failure triggers rollback.

| Check | Where | Fatal? |
|---|---|---|
| Laravel boots | `deploy.sh` (boots the framework via `php -r`) | ✅ |
| `APP_KEY` set | `deploy.sh` (same boot check) | ✅ |
| Migrations current (no pending) | `deploy.sh` (`migrate:status`) | ✅ |
| Homepage HTTP 200 (server-local via `--resolve`) | `deploy.sh` | ✅ on bad status; ⚠️ warn if unreachable locally (hairpin NAT) |
| Storage link present | `deploy.sh` | ⚠️ advisory (app doesn't use the public disk) |
| Homepage HTTP 200 (external, public) | workflow (`curl` w/ retries) | ✅ — the authoritative public check |

---

## 9. Troubleshooting & common failures

| Symptom | Likely cause | Fix |
|---|---|---|
| Workflow fails at **Deploy over SSH**, `Permission denied (publickey)` | `SERVER_SSH_KEY` wrong/missing, or pubkey not in `authorized_keys` | Re-check the secret (full PEM), confirm the pubkey on the server, verify `SERVER_USER`/`SERVER_HOST`/`SERVER_PORT` |
| SSH connects but `deploy.sh: command not found` / wrong dir | Repo not cloned at `SERVER_APP_DIR`, or path wrong | Do the [one-time setup](#4-one-time-server-setup-before-the-first-auto-deploy); set `SERVER_APP_DIR` |
| Deploy fails at **Composer** | `composer`/PHP not on PATH for non-interactive SSH, or network | Ensure PATH in the deploy user's shell; test `ssh deploy@host 'composer -V'` |
| Deploy fails at **npm run build** | `node`/`npm` missing on server | Install Node LTS for the deploy user; test `ssh deploy@host 'node -v'` |
| Deploy fails at **Migrations** | DB creds/permissions in server `.env` | Fix `DB_*` in `/var/www/gabhaenterprise/.env`; re-run |
| Health check: `APP_KEY missing` | `.env` has no `APP_KEY` | `php artisan key:generate` on the server (once) |
| Health check: server HTTP 000 warning | Hairpin NAT — server can't reach its own public URL | Non-fatal; the workflow's external check is authoritative |
| External homepage check fails (500) | App error after deploy | Check `storage/logs/laravel.log`; the code already auto-rolled-back — investigate before re-merging |
| Config change didn't take effect | `config:cache` is active | Re-deploy, or run `php artisan config:cache` on the server |
| Style check "failed" but deploy still ran | Pint is **advisory** by design | Run `vendor/bin/pint` locally, commit |

**Reading logs:** GitHub → Actions → the run → expand each step. On the server:
`tail -f /var/www/gabhaenterprise/storage/logs/laravel.log`.

---

## 10. Manual deploy (bypass GitHub Actions)

```bash
ssh deploy@<SERVER_HOST>
cd /var/www/gabhaenterprise
bash deploy/deploy.sh
```

This is identical to what CI runs — the workflow only adds the quality gate and
the external health check.

---

## 11. Disabling automatic deployment

Pick one:

- **Temporarily:** GitHub → Actions → *Deploy (production)* → **⋯ → Disable workflow**.
- **Per-commit skip:** include `[skip ci]` in the merge commit message.
- **Permanently:** delete or rename `.github/workflows/deploy.yml`
  (deploys then revert to fully manual `bash deploy/deploy.sh`).
- **Pause deploys but keep checks:** comment out the `deploy` job (keep `quality`).

---

## 12. Recommended branch protection (GitHub → Settings → Branches → `main`)

Protect `main` so only reviewed code deploys:

- ✅ **Require a pull request before merging** (no direct pushes to `main`).
- ✅ **Require approvals** — at least **1** review approval.
- ✅ **Require status checks to pass before merging** → select **`Pre-deploy checks`**
  (the `quality` job). Also enable **Require branches to be up to date**.
- ✅ **Require conversation resolution before merging.**
- ✅ **Do not allow bypassing the above settings** (apply to admins).
- ✅ **Restrict who can push** (block direct pushes; PR-only).
- ✅ **Block force pushes** to `main`.
- ✅ **Restrict deletions** of `main`.
- Optional: require signed commits; require linear history.

> Tip: since deploy runs *after* merge, the status check gates **merge**, not the
> deploy. That's intended — review + green checks happen on the PR, then merging
> to `main` ships it.
