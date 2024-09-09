<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public int $verificationCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, int $verificationCode)
    {
        $this->subject = $subject;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->subject)
            ->view('mail.verificationCode')
            ->with(['code' => $this->verificationCode]);
    }
}
