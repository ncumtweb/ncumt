<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CourseRecord;

class Course extends Mailable
{
    use Queueable, SerializesModels;

    private $courseRecord;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CourseRecord $courseRecord)
    {
        $this->courseRecord = $courseRecord;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ncumt40@gmail.com')
                    ->view('mail.notifyCourse')
                    ->subject( '「' . $this->courseRecord->course->title . '」' . '報名完成')
                    ->with([
                        'title' => $this->courseRecord->course->title,
                        'name' => $this->courseRecord->user->name_zh,
                        'date' => $this->courseRecord->course->date,
                        'speaker' => $this->courseRecord->course->speaker,
                        'location' => $this->courseRecord->course->location,
                    ]);
    }
}
