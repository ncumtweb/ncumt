<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const POSITION = ["社員", "社長", "副社長", "嚮導組組長", "嚮導組組員",
    '技術組組長', '技術組組員', '器材組組長', '器材組組長', '醫藥組組長',
    '醫藥組組員', '文書組組長', '文書組組員', '美宣', '網管',
    '財務長', '山防組組長', '山防組組員'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position = self::POSITION;

        $users = User::orderBy('created_at','asc')->get();
        return view('user.user', compact('users', 'position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $position = self::POSITION;

        //avoid url attack
        if(!$this->checkUser($id)) {
            return redirect()->route('index');
        }
        return view('user.information', compact('user', 'position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $position = self::POSITION;

        return(view('user.edit', compact('user', 'position')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBasicInformation(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'identifier' => 'nullable|string|max:255',
            'name_zh' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nickname' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:0,1',
            'personal_id' => 'nullable|string|max:20',
            'department_level' => 'nullable|string|max:255',
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->identifier = $request->input('identifier');
        $user->name_zh = $request->input('name_zh');
        $user->name_en = $request->input('name_en');
        $user->email = $request->input('email');
        $user->nickname = $request->input('nickname');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->personal_id = $request->input('personal_id');
        $user->department_level = $request->input('department_level');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '個人資料更新成功');
    }

    public function updateClubRoles(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            'guard' => 'required|string|max:255',
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->role = $request->input('role');
        $user->guard = $request->input('guard');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '俱樂部角色更新成功');
    }

    public function updatePhysicalCondition(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'special_disease' => 'nullable|string|max:255',
            'altitude_sickness' => 'required|string|max:255',  // 確保這裡的規則符合你的需求
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->special_disease = $request->input('special_disease');
        $user->altitude_sickness = $request->input('altitude_sickness');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '身體狀況更新成功');
    }

    public function updateEatingHabit(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'dietary_habit' => 'required|string|max:255',
            'favorite_foods' => 'nullable|string|max:255',
            'allergic_foods' => 'nullable|string|max:255',
            'hate_foods' => 'nullable|string|max:255',
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->dietary_habit = $request->input('dietary_habit');
        $user->favorite_foods = $request->input('favorite_foods');
        $user->allergic_foods = $request->input('allergic_foods');
        $user->hate_foods = $request->input('hate_foods');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '飲食習慣更新成功');
    }

    public function updateContactInformation(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'emergency_contact_person' => 'nullable|string|max:255',
            'emergency_contact_relation' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'home_phone_number' => 'nullable|string|max:255',
            'home_address' => 'nullable|string|max:255',
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->emergency_contact_person = $request->input('emergency_contact_person');
        $user->emergency_contact_relation = $request->input('emergency_contact_relation');
        $user->emergency_contact_phone = $request->input('emergency_contact_phone');
        $user->home_phone_number = $request->input('home_phone_number');
        $user->home_address = $request->input('home_address');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '聯絡資訊更新成功');
    }

    public function updateMountaineeringDeeds(Request $request, $id)
    {
        // 驗證表單數據
        $validatedData = $request->validate([
            'days_in_mountain' => 'nullable|integer',
            'times_climbed_mountain' => 'nullable|integer',
            'five_kilograms_running_time' => 'nullable|string|max:255',
            'join_the_club_time' => 'nullable|string|max:255',
        ]);

        // 獲取用戶
        $user = User::findOrFail($id);

        // 更新用戶資料
        $user->days_in_mountain = $request->input('days_in_mountain');
        $user->times_climbed_mountain = $request->input('times_climbed_mountain');
        $user->five_kilograms_running_time = $request->input('five_kilograms_running_time');
        $user->join_the_club_time = $request->input('join_the_club_time');

        // 設置更新者和更新時間
        $user->modify_user = auth()->user()->id;
        $user->updated_at = now();

        // 保存變更
        $user->save();

        // 重定向並顯示成功訊息
        return redirect()->back()->with('status', '登山紀錄更新成功');
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

    public function checkUser($id) {
        if ($id != Auth::user()->id) {
            return false;
        }
        else {
            return true;
        }
    }

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('modify_user')->nullable()->comment('更新者 ID');
            $table->timestamp('updated_at')->useCurrent()->comment('Updated At');
        });
    }

}
