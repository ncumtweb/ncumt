<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class TripController extends Controller
{
    public function create() // 會連到 web.php 的 function
    {
        if (Auth::check() && Auth::user()->role > 0) {
            if (Auth::user()->guard != 0) {
                return view('trip.create');
            }
            // 等隊伍畫面完成後，想導回隊伍頁面，加入以下內容
            /*
             *    @if (session('status'))
             *    <div class="col-lg-12 text-center">
             *      <h6 class="alert alert-danger">{{ session('status') }}</h6>
             *    </div>
             */
            return redirect()->route('index')->with('status', '您不具有嚮導資格，無法進行操作。');
        }
        return redirect()->route('portal.index')->with('status', '您並無權限進行此操作，請先登入。');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role > 0) {
            if (Auth::user()->guard != 0) {
                if (!is_numeric($id)) {
                    return redirect()->back()->with('error', '無效的隊伍 ID');
                }
                // 根據 ID 取得現有資料
                $trip = Trip::find($id);
                if (!$trip) {
                    return redirect()->back()->with('error', '找不到該隊伍');
                } else {
                    $trip->registration_open = Carbon::parse($trip->registration_open);
                    $trip->registration_close = Carbon::parse($trip->registration_close);
                    $trip->quit_date = Carbon::parse($trip->quit_date);
                    $trip->pre_departure_time = Carbon::parse($trip->pre_departure_time);
                    $trip->start_date = Carbon::parse($trip->pre_departure_time);
                    $trip->end_date = Carbon::parse($trip->end_date);

                    return view('trip.edit', compact('trip'));
                }
            } else {
                return redirect()->route('index')->with('status', '您不具有嚮導資格，無法進行操作。');
            }
        }
        return redirect()->route('portal.index')->with('status', '您並無權限進行此操作，請先登入。');

    }

    // 創建新隊伍資料
    public function store(Request $request)
    {
        // validate date
        $validator = Validator::make($request->all(), [
            'registration_close' => 'after_or_equal:registration_open',
            'quit_date' => 'after_or_equal:registration_close',
            'pre_departure_time' => 'after_or_equal:quit_date',
            'start_date' => 'after_or_equal:pre_departure_time',
            'end_date' => 'after_or_equal:start_date',

        ], [
            'registration_close.after_or_equal' => '報名截止日期需在報名開始日期之後。',
            'quit_date.after_or_equal' => '鳥隊日期需在報名截止日期之後。',
            'pre_departure_time.after_or_equal' => '行前會日期需在鳥隊日期之後。',
            'start_date.after_or_equal' => '隊伍開始日期需在行前會日期之後。',
            'end_date.after_or_equal' => '結束日期需在開始日期之後。',
            'image.required' => '請上傳封面照。',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $trip = new Trip();

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

        $trip->total_day = (strtotime($trip->end_date) - strtotime($trip->start_date) + $trip->prepare_day) / 86400;

        // 檢查按鈕的值
        $action = $request->input('action');

        if ($action == 'update') {
            $trip->isActive = false;
            $trip->save();
            return redirect()->back()->with('status', '隊伍資料儲存成功');
        } elseif ($action == 'publish') {
            $trip->isActive = true;
            $trip->save();
            return redirect()->back()->with('status', '隊伍資料發布成功');
        }

    }

    // 修改新隊伍資料
    public function update(Request $request, $id)
    {

        $trip = Trip::find($id);
        if (!$trip) {
            return redirect()->back()->with('error', '找不到該隊伍');
        } else {
            // validate date
            $validator = Validator::make($request->all(), [
                'registration_close' => 'after_or_equal:registration_open',
                'quit_date' => 'after_or_equal:registration_close',
                'pre_departure_time' => 'after_or_equal:quit_date',
                'start_date' => 'after_or_equal:pre_departure_time',
                'end_date' => 'after_or_equal:start_date',

            ], [
                'registration_close.after_or_equal' => '報名截止日期需在報名開始日期之後。',
                'quit_date.after_or_equal' => '鳥隊日期需在報名截止日期之後。',
                'pre_departure_time.after_or_equal' => '行前會日期需在鳥隊日期之後。',
                'start_date.after_or_equal' => '隊伍開始日期需在行前會日期之後。',
                'end_date.after_or_equal' => '結束日期需在開始日期之後。',
                'image.required' => '請上傳封面照。',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

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
            }
        }
    }
}
