<?php

namespace App\Http\Controllers;

use App\Mail\Course\CourseRegister;
use App\Models\Course;
use App\Models\CourseRecord;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::whereNotNull('videoURL')->orderBy('start_date','desc')->get();
        return view('course.course', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->image;
        $folder_name = "uploads/images/courses";
        $name = $request->input('title');



        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');
        $course->speaker = $request->input('speaker');
        $course->location = $request->input('location');
        $course->image = $this->storeImage($file, $folder_name, $name);
        if($request->input('videoURL')) {
            $course->videoURL = $request->input('videoURL');
        }
        if($request->input('pptURL')) {
            $course->pptURL = $request->input('pptURL');
        }
        $course->create_user = Auth::user()->id;
        $course->modify_user = Auth::user()->id;

        $course->save();

        return redirect()->route('course.showRegister')->with('status','社課新增成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
    {

        $courses = Course::where('videoURL', null)
            ->whereDate('start_date', '>=' , now()->toDateString())
            ->orderBy('start_date','asc')
            ->get();


        return view('course.register', compact('courses'));
    }

    public function register($id) {

        $courseRecord = new CourseRecord();

        $courseRecord->course_id = $id;
        $courseRecord->user_id = auth()->user()->id;
        $courseRecord->save();

        $msg = auth()->user()->name . '「' . $courseRecord->course->title. '」' . '社課報名完成';

        Mail::to($courseRecord->user->email)
            ->later(now()->addSeconds(5), new CourseRegister($courseRecord));

        return redirect()->back()->with('status', $msg);
    }

    public function showRecord() {
        $courseRecords = CourseRecord::where('user_id', auth()->user()->id)->get();
        return view('course.record', compact('courseRecords'));
    }

    public function showAllRecords($id) {
        $course = Course::findOrFail($id);
        $courseRecords = CourseRecord::where('course_id', $id)->orderBy('created_at', 'asc')->get();
        return view('course.allRecords', compact('course', 'courseRecords'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);

        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if($request->image) {
            File::delete(public_path($course->image));
            $file = $request->image;
            $folder_name = "uploads/images/courses";
            $name = $request->input('title');
            $course->image = $this->storeImage($file, $folder_name, $name);
        }

        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');
        $course->speaker = $request->input('speaker');
        $course->location = $request->input('location');

        if($request->input('videoURL')) {
            $course->videoURL = $request->input('videoURL');
        }
        if($request->input('pptURL')) {
            $course->pptURL = $request->input('pptURL');
        }
        $course->modify_user = Auth::user()->id;
        $course->update();

        return redirect()->route('course.showRegister')->with('status','社課更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        File::delete(public_path($course->image));
        $course->delete();
        return redirect()->intended(url()->previous())->with('status','社課刪除成功');
    }
}
