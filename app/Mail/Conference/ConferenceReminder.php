<?php

namespace App\Mail\Conference;

use App\Models\ConferenceUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ConferenceReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param ConferenceUser $conferenceUser
     */
    public function __construct(private readonly ConferenceUser $conferenceUser)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $subject = '「第二十五屆全國大專校院登山運動研討會」報名提醒';

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->view('mail.conference.conferenceReminder', ['conferenceUser' => $this->conferenceUser])
            ->subject($subject)
            ->attach('app/Mail/Conference/Attachment/reminder.pdf', [
                'as' => '第二十五屆全國大專校院登山運動研討會-行前通知.pdf',
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * 研討會的前一天發送提醒的信件
     *
     * @return void
     */
    public static function sendEmail(): void
    {
        $conferenceUsers = ConferenceUser::all();
        if ($conferenceUsers->isEmpty()) {
            return;
        }
        foreach ($conferenceUsers as $conferenceUser) {
            Mail::to($conferenceUser->email)->queue(new ConferenceReminder($conferenceUser));
            Log::info('send conference reminder email to ' . $conferenceUser->email);
        }
    }
}
