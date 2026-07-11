<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    /**
     * Public contact form — no auth required.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:120'],
            'company' => ['nullable', 'string', 'max:150'],
            'email'   => ['required', 'email:rfc', 'max:180'],
            'phone'   => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],

            // Honeypot: a hidden field real users never fill. Bots do.
            // Must be present (rendered) but empty.
            'website' => ['present', 'max:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'    => 'name',
            'company' => 'company',
            'email'   => 'email address',
            'phone'   => 'phone number',
            'message' => 'message',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'website.max'     => 'Your submission could not be processed.',
            'website.present' => 'Your submission could not be processed.',
            'phone.regex'     => 'Please enter a valid phone number.',
        ];
    }

    /**
     * Only the persisted fields — the honeypot is dropped here.
     *
     * @return array<string, mixed>
     */
    public function inquiryData(): array
    {
        return [
            ...$this->safe()->only(['name', 'company', 'email', 'phone', 'message']),
            'ip_address' => $this->ip(),
        ];
    }
}
