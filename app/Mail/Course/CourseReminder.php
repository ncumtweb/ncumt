<?php

namespace App\Mail\Course;

use App\Models\Course;
use App\Models\User;
use App\Utils\DateFormatter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CourseReminder extends Mailable
{
    use Queueable, SerializesModels;

    private Course $course;

    private User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course, User $user)
    {
        $this->course = $course;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $date = DateFormatter::formatRange($this->course->start_date, $this->course->end_date);
        return $this->from('ncumt40@gmail.com')
            ->subject('「' . $this->course->title . '」' . '報名提醒')
            ->view('mail.course.remindCourse')
            ->with([
                'title' => $this->course->title,
                'name' => $this->user->name_zh,
                'date' => $date,
                'speaker' => $this->course->speaker,
                'location' => $this->course->location,
            ]);
    }

    /**
     * 社課前一天寄送報名提醒
     * @return void
     */
    public static function sendEmail(): void
    {
        $courses = Course::where('start_date', now()->addDay()->toDateString())->get();

        if ($courses->isEmpty()) {
            return;
        }
        foreach ($courses as $course) {
            if ($course->users->isEmpty()) {
                continue;
            }
            foreach ($course->users as $user) {
                Mail::to($user->email)->send(new CourseReminder($course, $user));
                Log::info('Sending email to ' . $user->email . ', course title: ' . $course->title);
            }
        }
    }
}
