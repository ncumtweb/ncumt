<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar_events = array();
        $events = Event::all();
        $category_array =['#A8D8B9', '#7DB9DE','#E6E5A3', '#9B90C2', '#E87A90']; // 0 => 爬山(綠色), 1 => 溯溪(藍色), 2 => 社課(黃色), 3 => 開會(紫色), 4' => 山防(紅色)
        $category = ['0' => "出隊 | ", '1' => "出隊 | ", '2' => "社課 | ", '3' => "討論 | ", '4' => "山防 | "];
        foreach ($events as $event) {
            $calendar_events[] = [
                'id' => $event->id,
                'title' => $category[$event->category] . $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'color' => $category_array[$event->category],
            ];
        }
        
        return $calendar_events;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->title = $request->input('title');
        $event->category = $request->input('category');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->save();
        return redirect()->route('index');
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
        $event = Event::find($id);
        return view('calendar.edit', compact('event'));
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
        $event = Event::findorFail($id);
        $event->title = $request->input('title');
        $event->category = $request->input('category');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->update();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findorFail($id);
        $event->delete();
        return redirect()->route('index');
    }
}
