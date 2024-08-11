<?php

namespace App\Mail\Conference;

use App\Enums\Mode;
use App\Models\ConferenceUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConferenceRegister extends Mailable
{
    use Queueable, SerializesModels;

    private ConferenceUser $conferenceUser;

    private Mode $mode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ConferenceUser $conferenceUser, Mode $mode)
    {
        $this->conferenceUser = $conferenceUser;
        $this->mode = $mode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $registerOrEdit = Mode::CREATE == $this->mode ? '報名' : '資料修改';
        $subject = '「第二十五屆全國大專校院登山運動研討會」' . $registerOrEdit . '成功';

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->view('mail.conference.conferenceRegister')
            ->subject($subject)
            ->with(['conferenceUser' => $this->conferenceUser,]
            );
    }
}
