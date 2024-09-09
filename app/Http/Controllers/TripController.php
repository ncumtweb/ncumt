<?php

namespace App\Http\Controllers;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\File;
use App\Enums\JudgementRank;
use App\Enums\RouteCategory;

class TripController extends Controller
{
    use ImageTrait;
    public function __construct()
    {
        $this->middleware('TripAuthenticate');
    }

    public function create() // 會連到 web.php 的 function
    {
        $judgement_ids = JudgementRank::cases(); // Get all enum instances
        $categories = RouteCategory::cases();
        return view('trip.create', compact('judgement_ids', 'categories'));

    }

    public function edit($id)
    {
                if (!is_numeric($id)) {
                    return redirect()->back()->with('error', '無效的隊伍 ID');
                }
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
                    $judgement_ids = JudgementRank::cases();
                    $categories = RouteCategory::cases();

                    return view('trip.edit',  compact('trip', 'judgement_ids', 'categories'));
        }
    }

    // 創建新隊伍資料
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expected_fee' => 'required|integer|min:0',
            'expected_member_count' => 'required|integer|min:0',
            'expected_cadre_count' => 'required|integer|min:0',
            'actual_fee' => 'required|integer|min:0',
            'registration_open' => 'after:today',
            'registration_close' => [
                'required',
                'date',
                'after:today',
                'after_or_equal:registration_open',
            ],
            'quit_date'  => [
                'required',
                'date',
                'after:today',
                'after_or_equal:registration_close',
            ],
            'pre_departure_time'  => [
                'required',
                'date',
                'after:today',
                'after_or_equal:quit_date',
            ],
            'start_date' => [
                'required',
                'date',
                'after:today',
                'after_or_equal:pre_departure_time',
            ],
            'end_date' => [
                'required',
                'date',
                'after:today',
                'after_or_equal:start_date',
            ],
            'prepare_day' => 'required|integer|min:0'
        ], [
            'expected_fee.integer' => '預期費用輸入內容須為大於零的整數。',
            'expected_member_count.integer' => '預期成員數輸入內容須為大於零的整數。',
            'expected_cadre_count.integer' => '預期幹部數輸入內容須為大於零的整數。',
            'actual_fee.integer' => '實際費用輸入內容須為大於零的整數。',
            'registration_open.after' => '報名開始日期需晚於今日。',
            'registration_close.after_or_equal' => '報名截止日期需在報名開始日期之後。',
            'registration_close.after' => '報名截止日期需晚於今日。',
            'quit_date.after_or_equal' => '鳥隊日期需在報名截止日期之後。',
            'quit_date.after' => '鳥隊日期需晚於今日。',
            'pre_departure_time.after_or_equal' => '行前會日期需在鳥隊日期之後。',
            'pre_departure_time.after' => '行前會日期需晚於今日。',
            'start_date.after_or_equal' => '隊伍開始日期需在行前會日期之後。',
            'start_date.after' => '隊伍開始日期需晚於今日。',
            'end_date.after_or_equal' => '結束日期需在開始日期之後。',
            'end_date.after' => '結束日期需晚於今日。',
            'image.required' => '請上傳封面照。',
            'prepare_day.min' => '預備天日期必須為正整數或零。',
            'prepare_day.integer' => '預備天日期必須為正整數或零。'
        ]);
        $file = $request->image;
        $folder_name = "uploads/images/trips";
        $name = $request->input('name');


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
        $trip->image = $this->storeImage($file, $folder_name, $name);
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

        $trip->total_day = (strtotime($trip->end_date) - strtotime($trip->start_date) ) / 86400 + $trip->prepare_day;

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
                'expected_fee' => 'required|integer|min:0',
                'expected_member_count' => 'required|integer|min:0',
                'expected_cadre_count' => 'required|integer|min:0',
                'actual_fee' => 'required|integer|min:0',
                'registration_open' => 'after:today',
                'registration_close' => [
                    'required',
                    'date',
                    'after:today',
                    'after_or_equal:registration_open',
                ],
                'quit_date'  => [
                    'required',
                    'date',
                    'after:today',
                    'after_or_equal:registration_close',
                ],
                'pre_departure_time'  => [
                    'required',
                    'date',
                    'after:today',
                    'after_or_equal:quit_date',
                ],
                'start_date' => [
                    'required',
                    'date',
                    'after:today',
                    'after_or_equal:pre_departure_time',
                ],
                'end_date' => [
                    'required',
                    'date',
                    'after:today',
                    'after_or_equal:start_date',
                ],
                'prepare_day' => 'required|integer|min:0'

            ], [
                'expected_fee.integer' => '預期費用輸入內容須為大於零的整數。',
                'expected_member_count.integer' => '預期成員數輸入內容須為大於零的整數。',
                'expected_cadre_count.integer' => '預期幹部數輸入內容須為大於零的整數。',
                'actual_fee.integer' => '實際費用輸入內容須為大於零的整數。',
                'registration_open.after' => '報名開始日期需晚於今日。',
                'registration_close.after_or_equal' => '報名截止日期需在報名開始日期之後。',
                'registration_close.after' => '報名截止日期需晚於今日。',
                'quit_date.after_or_equal' => '鳥隊日期需在報名截止日期之後。',
                'quit_date.after' => '鳥隊日期需晚於今日。',
                'pre_departure_time.after_or_equal' => '行前會日期需在鳥隊日期之後。',
                'pre_departure_time.after' => '行前會日期需晚於今日。',
                'start_date.after_or_equal' => '隊伍開始日期需在行前會日期之後。',
                'start_date.after' => '隊伍開始日期需晚於今日。',
                'end_date.after_or_equal' => '結束日期需在開始日期之後。',
                'end_date.after' => '結束日期需晚於今日。',
                'image.required' => '請上傳封面照。',
                'prepare_day.min' => '預備天日期必須為正整數或零。',
                'prepare_day.integer' => '預備天日期必須為正整數或零。'
            ]);

            if($request->image) {
                File::delete(public_path($trip->image));
                $file = $request->image;
                $folder_name = "uploads/images/records";
                $name = $request->input('name');
                $trip->image = $this->storeImage($file, $folder_name, $name);
            }

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
            $trip->total_day = (strtotime($trip->end_date) - strtotime($trip->start_date) ) / 86400 + $trip->prepare_day;

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
