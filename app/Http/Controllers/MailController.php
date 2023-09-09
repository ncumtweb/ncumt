<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller {

    public function sendEmail(Request $request) {

        $recipients = ['xiangrong910227@gmail.com', 'ben901227@gmail.com'];

        Mail::send('mail.test', ['name' => '中央大學登山社'],
        function($mail) {
            $mail->to('xiangrong910227@gmail.com');
            $mail->subject('中央大學登山社');
        });
    }
}