<?php

namespace App\Http\Controllers;

use App\Enums\Common;
use App\Enums\LoginMethod;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class PortalLoginController extends Controller
{
    public function index()
    {
        session(['previous_page' => url()->previous()]);
        return view('basic.portal');
    }

    public function redirectToProvider()
    {
        return Socialite::with('portal')->redirect();
    }

    public function handleProviderCallback(): \Illuminate\Http\RedirectResponse
    {
        $user_portal = Socialite::with('portal')->stateless()->user();
        $studentId = $user_portal->user['studentId'] ?? null;
        if (is_null($studentId)) {
            $existUser = User::where('email', $user_portal->user['email'])->first();
        } else {
            $existUser = User::where('student_id', $studentId)->first();
        }
        $academyRecords = $user_portal->user['academyRecords'] ?? null;
        if (is_null($existUser)) {
            $user = new User();
            $user->student_id = $studentId;
            $user->name_zh = $user_portal->user['chineseName'] ?? $user_portal->user['email'];
            $user->name_en = $user_portal->user['englishName'] ?? null;
            $user->email = $user_portal->user['email'];
            $user->phone = $user_portal->user['mobilePhone'] ?? null;
            $user->personal_id = $user_portal->user['personalId'] ?? null;
            $user->gender = $user_portal->user['gender'] ?? null;
            $user->birthday = $user_portal->user['birthday'] ?? null;
            $user->department_level = $this->getDepartmentLevel($academyRecords);
            $user->login_method = LoginMethod::PORTAL;
            $user->create_user = Common::SYSTEM_USER;
            $user->modify_user = Common::SYSTEM_USER;
            $user->save();
            Auth::login($user);
        } else {
            // 之前登入的人若沒有以下資料，要重新寫入
            $existUser->phone = $existUser->phone ?? ($user_portal->user['mobilePhone'] ?? null);
            $existUser->personal_id = $existUser->personal_id ?? ($user_portal->user['personalId'] ?? null);
            $existUser->gender = $existUser->gender ?? ($user_portal->user['gender'] ?? null);
            $existUser->birthday = $existUser->birthday ?? ($user_portal->user['birthday'] ?? null);
            $existUser->department_level = $existUser->department_level ?? $this->getDepartmentLevel($academyRecords);
            $existUser->login_method = $existUser->login_method ?? LoginMethod::PORTAL;
            $existUser->save();
            Auth::login($existUser);
        }
        $this->logUserLoginInfo();

        if (session()->has('previous_page')) {
            $url = session('previous_page');
            if ($url != config('app.url') . '/portal') {
                session()->forget('previous_page');
                return redirect()->intended($url);
            }
        }

        return redirect()->route('index');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        // 將目前使用者登出
        Auth::logout();

        return redirect()->intended(url()->previous());
    }

    private function getDepartmentLevel($academyRecords)
    {
        // 檢查 $academyRecords 是否為 null
        if (is_null($academyRecords)) {
            return null;
        }

        // 建立年級的對應關係
        $grades = [
            '1' => '一年級',
            '2' => '二年級',
            '3' => '三年級',
            '4' => '四年級'
        ];

        // 取得年級的第一個數字
        $gradeNumber = substr($academyRecords['grad'], 0, 1);
        $grade = $grades[$gradeNumber] ?? '';

        // 組合最終的結果
        if ($academyRecords['name'] && $grade) {
            return "{$academyRecords['name']}$grade";
        }

        return $academyRecords['name']; // 如果資料不完整，返回系名
    }

    private function logUserLoginInfo(): void
    {
        $user = Auth::user();

        Log::info('User login', [
            'name_zh' => $user->name_zh,
            'student_id' => $user->student_id
        ]);
    }
}
