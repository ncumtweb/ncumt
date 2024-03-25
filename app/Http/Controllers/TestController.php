<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        // $test = 123;
        // dd($test);
        return view('test.test');
    }
}