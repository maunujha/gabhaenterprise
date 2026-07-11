<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        $inquiry = Inquiry::create($request->inquiryData());

        // The lead is captured the moment it is persisted; the notification
        // email is a convenience. A mail/transport failure must never lose
        // the inquiry or 500 the visitor — log it and carry on.
        try {
            Mail::to(config('company.inquiry_recipient'))
                ->send(new InquiryReceived($inquiry));
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('inquiry_sent', true);
    }
}
