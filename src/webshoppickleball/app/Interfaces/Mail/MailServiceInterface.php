<?php

namespace App\Interfaces\Mail;

interface MailServiceInterface
{
    public function sendOtp(string $to, string $otp): void;
}
