<?php

namespace App\Services\Mail;

use App\Interfaces\Mail\MailServiceInterface;
use Illuminate\Support\Facades\Mail;
use App\Services\Mail\SendOtp;

class MailService implements MailServiceInterface
{
    public function sendOtp(string $to, string $otp): void
    {
        Mail::to($to)->send(new SendOtp($otp));
    }
}
