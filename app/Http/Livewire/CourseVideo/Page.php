<?php

namespace App\Http\Livewire\CourseVideo;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $amountOfPages = 5; //5 records per page

    public function render()
    {
        $courses = Course::whereNotNull('videoURL')->orderBy('start_date', 'desc')->paginate($this->amountOfPages);
        return view('livewire.course-video.page', [
            'courses' => $courses
        ]);
    }

    /**
     * 觸發滾動到頂端
     * @return void
     */
    public function updatedPage()
    {
        $this->dispatchBrowserEvent('scroll-to-top');
    }
}
