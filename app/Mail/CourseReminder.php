<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CourseRecord;
use App\Models\User;

class CourseReminder extends Mailable
{
    use Queueable, SerializesModels;

    private $course;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course, $user)
    {
        $this->course = $course;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ncumt40@gmail.com')
                    ->view('mail.remindCourse')
                    ->subject( '「' . $this->course->title . '」' . '報名提醒')
                    ->with([
                        'title' => $this->course->title,
                        'name' => $this->user->name_zh,
                        'date' => $this->course->date,
                        'speaker' => $this->course->speaker,
                        'location' => $this->course->location,
                    ]);
    }
}
