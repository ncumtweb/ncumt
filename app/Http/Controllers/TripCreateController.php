<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class TripCreateController extends Controller
{
    public function create() // 會連到 web.php 的 function
    {
        if(Auth::check() && Auth::user()->role > 0){
            return view('trip.create');
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


    public function update(Request $request)
    {
        $trip = New Trip();

//        $<table名稱>-><blade.php的id/name> = $request->input('<DB的項目名稱>');

        $trip->leader_id = auth()->user()->id;
        $trip->name = $request->input('name');
        $trip->expected_member_count = $request->input('expected_member_count');
        $trip->expected_cadre_count = $request->input('expected_cadre_count');
        $trip->description = $request->input('description');
        $trip->category = $request->input('category');
        $trip->start_date = $request->input('start_date');
        $trip->end_date = $request->input('end_date');
        $trip->image = $request->file('image');
        $trip->actual_fee = $request->input('actual_fee');
        $trip->expected_fee = $request->input('expected_fee');
        $trip->registration_open = $request->input('registration_open');
        $trip->registration_close = $request->input('registration_close');
        $trip->pre_departure_time = $request->input('pre_departure_time');
        $trip->judgements_id = $request->input('judgements_id');
        $trip->create_user = auth()->user()->id;

        $trip->save();

        return redirect()->back()->with('status','隊伍資料更新成功');
        //return redirect()->route('trip.create'); // 預計導回所有隊伍頁面…但似乎bar上還沒有

    }



}



