<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class TripCreateController extends Controller
{
    public function create() // 會連到 web.php 的 function
    {
        if(Auth::check() && Auth::user()->role > 0){
            return view('trip.create');
        }

        return redirect()->route('portal.index')->with('status','您並無權限進行此操作，請先登入。');
    }

    public function edit($id)
    {
        if(Auth::check() && Auth::user()->role > 0){
            if (!is_numeric($id)) {
                return redirect()->back()->with('error', '無效的隊伍 ID');

            }
            // 根據 ID 取得現有資料
            $trip = Trip::find($id);
            if(!$trip){
                return redirect()->back()->with('error', '找不到該隊伍');
            }else{
                $trip->start_date = Carbon::parse($trip->start_date);
                $trip->end_date = Carbon::parse($trip->end_date);
                $trip->quit_date = Carbon::parse($trip->quit_date);
                $trip->registration_open = Carbon::parse($trip->registration_open);
                $trip->registration_close = Carbon::parse($trip->registration_close);
                $trip->pre_departure_time = Carbon::parse($trip->pre_departure_time);
                return view('trip.edit', compact('trip'));
            }
        }
        return redirect()->route('portal.index')->with('status','您並無權限進行此操作，請先登入。');

    }

    public function handleRequest1(Request $request) {

        $trip = New Trip();

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
        $trip->prepare_day = $request->input('prepare_day');
        $trip->create_user = auth()->user()->id;
        $trip->quit_date = $request->input('quit_date');
        $trip->quit_rule = $request->input('quit_rule');
        $trip->additional_content = $request->input('additional_content');

        $trip->total_day = (strtotime($trip->end_date) - strtotime($trip->start_date) + $trip->prepare_day)/86400;

        // 檢查按鈕的值
        $action = $request->input('action');

        if ($action == 'update') {
            $trip->isActive = false;
            $trip->save();
            return redirect()->back()->with('status','隊伍資料儲存成功');
        } elseif ($action == 'publish') {
            $trip->isActive = true;
            $trip->save();
            return redirect()->back()->with('status','隊伍資料發布成功');
        } else {
            return redirect()->back()->with('error', '未知的操作');
        }

    }
    public function handleRequest2(Request $request, $id) {

        $trip = Trip::find($id);
        if (!$trip) {
            return redirect()->back()->with('error', '找不到該隊伍');
        }else {
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
            $trip->modify_user = auth()->user()->id;
            $trip->prepare_day = $request->input('prepare_day');
            $trip->quit_date = $request->input('quit_date');
            $trip->quit_rule = $request->input('quit_rule');
            $trip->additional_content = $request->input('additional_content');
            $trip->total_day = (strtotime($trip->end_date) - strtotime($trip->start_date) + $trip->prepare_day) / 86400;

            // 檢查按鈕的值
            $action = $request->input('action');

            if ($action == 'update') {
                $trip->isActive = false;
                $trip->save();
                return redirect()->back()->with('status', '隊伍資料更新成功');
            } elseif ($action == 'publish') {
                $trip->isActive = true;
                $trip->save();
                return redirect()->back()->with('status', '隊伍資料發布成功');
            } else {
                return redirect()->back()->with('error', '未知的操作');
            }
        }
    }





}
