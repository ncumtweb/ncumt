<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = (new PostController)->index();
        $calendar_events = (new CalendarController)->index();

        $type_array = ["隊伍", "社課", "其他"];
        $tag_array = ["#A8D8B9", "#E6E5A3", "#9B90C2"];

        $records = Record::orderBy('start_date', 'desc')->limit(10)->get();
        $category_array = ["中級山", "高山", "溯溪"];

        return view('basic.index', compact('records', 'category_array', 'posts', 'type_array', 'tag_array', 'calendar_events'));
    }
}
