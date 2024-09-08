<?php

namespace App\Mail\Course;

use App\Models\CourseRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseRegister extends Mailable
{
    use Queueable, SerializesModels;

    private CourseRecord $courseRecord;

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
    public function build(): static
    {
        return $this->from('ncumt40@gmail.com')
            ->view('mail.course.notifyCourse')
            ->subject('「' . $this->courseRecord->course->title . '」' . '報名完成')
            ->with([
                'title' => $this->courseRecord->course->title,
                'name' => $this->courseRecord->user->name_zh,
                'date' => $this->courseRecord->course->date,
                'speaker' => $this->courseRecord->course->speaker,
                'location' => $this->courseRecord->course->location,
            ]);
    }
}
