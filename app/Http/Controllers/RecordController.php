<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::orderBy('start_date','desc')->get();
        $category_array = ["中級山", "高山", "溯溪"];
        return view('record.record', compact('records', 'category_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->role > 0){
            return view('record.create');
        }

        return redirect()->route('portal.index')->with('status','您並無權限進行此操作，請先登入。');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'end_date' => 'after_or_equal:start_date',
            'image' => 'required',
            'CKeditor' => 'required',

        ], [
            'end_date.after_or_equal' => '結束日期需在開始日期之後。',
            'image.required' => '請上傳封面照。',
            'CKeditor.required' => '請填寫紀錄內容。',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $file = $request->image;
        $folder_name = "uploads/images/records";
        $name = $request->input('name');

        $record = New Record();
        $record->name = $request->input('name');
        $record->description = $request->input('description');
        $record->category = $request->input('category');
        $record->start_date = $request->input('start_date');
        $record->end_date = $request->input('end_date');
        $record->image = $this->storeImage($file, $folder_name, $name);
        $record->content = $request->input('CKeditor');
        $record->save();

        return redirect()->route('record.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $record = Record::findOrFail($id);
        $category_array = ["中級山", "高山", "溯溪"];
        return view('record.show', ['record' => $record, 'category_array' => $category_array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Record::findOrFail($id);

        if(Auth::check() && Auth::user()->role > 0){
            return view('record.edit', compact('record'));
        }

        return redirect()->route('portal.index')->with('status','您並無權限進行此操作，請先登入。');
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
        $record = Record::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'end_date' => 'after_or_equal:start_date',
            'CKeditor' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status','結束日期需在開始日期之後，請再次確認。');
        }

        if($request->image) {
            File::delete(public_path($record->image));
            $file = $request->image;
            $folder_name = "uploads/images/records";
            $name = $request->input('name');
            $record->image = $this->storeImage($file, $folder_name, $name);
        }

        $record->name = $request->input('name');
        $record->description = $request->input('description');
        $record->category = $request->input('category');
        $record->start_date = $request->input('start_date');
        $record->end_date = $request->input('end_date');
        $record->content = $request->input('CKeditor');
        $record->update();

        return redirect()->route('record.show', $record->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $record = Record::findOrFail($id);

        if(Auth::check() && Auth::user()->role > 0){
            File::delete(public_path($record->image));
            $record->delete();
            return redirect()->route('record.index')->with('status','紀錄刪除成功');
        }

        return redirect()->route('portal.index')->with('status','您並無權限進行此操作，請先登入。');
    }

    public function storeImage($file, $folder_name, $name) {

        $upload_path = public_path() . '/' . $folder_name;
        $extension  =  $file->extension();
        $filename = $name  . time() . '.' . $extension;
        $file->move($upload_path, $filename);
        ImageOptimizer::optimize($folder_name . '/' . $filename);

        return $folder_name . '/' . $filename;
    }

    public function uploadImage(Request $request) {

        if ($request->hasFile('upload')) {
            $folder_name = "uploads/images/records";
            $upload_path = public_path() . '/' . $folder_name;
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move($upload_path, $fileName);

            $url = asset($folder_name . '/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }

    }
}
