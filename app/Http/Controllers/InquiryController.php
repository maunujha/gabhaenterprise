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

        Mail::to(config('company.inquiry_recipient'))
            ->send(new InquiryReceived($inquiry));

        return back()->with('inquiry_sent', true);
    }
}
