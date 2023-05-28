<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('date','desc')->get();
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
        $upload_path = public_path() . '/' . $folder_name;
        $extension  =  $file->extension();
        $filename = $request->input('title') . time() . '.' . $extension;
        $file->move($upload_path, $filename);
        
        
        $course = new Course();

        $course->title = $request->input('title');
        $course->date = $request->input('date');
        $course->image = $folder_name  . '/' . $filename;
        if($request->input('videoURL')) {
            $course->videoURL = $request->input('videoURL');
        }
        if($request->input('pptURL')) {
            $course->pptURL = $request->input('pptURL');
        }

        $course->save();

        return redirect()->route('course.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            //dd(public_path($course->image));
            File::delete(public_path($course->image));
            $file = $request->image;
            $folder_name = "uploads/images/courses";
            $upload_path = public_path() . '/' . $folder_name;
            $extension  =  $file->extension();
            $filename = $request->input('title') . time() . '.' . $extension;
            $file->move($upload_path, $filename);
            $course->image = $folder_name . '/' . $filename;
        }

        $course->title = $request->input('title');
        $course->date = $request->input('date');
        
        if($request->input('videoURL')) {
            $course->videoURL = $request->input('videoURL');
        }
        if($request->input('pptURL')) {
            $course->pptURL = $request->input('pptURL');
        }
        $course->update();

        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
