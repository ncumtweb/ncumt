<?php

namespace App\Http\Controllers;

use App\Enums\Common;
use App\Enums\LoginMethod;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PortalLoginController extends Controller
{
    public function index()
    {
        session(['previous_page' => url()->previous()]);
        return view('basic.portal');
    }

    public function redirectToProvider()
    {
        return \Socialite::with('portal')->redirect();
    }

    public function handleProviderCallback(): \Illuminate\Http\RedirectResponse
    {
        $user_portal = \Socialite::with('portal')->stateless()->user();
        Log::debug('user login, user array: ', array($user_portal));
        $existUser = User::where('student_id', $user_portal->user['studentId'])->first();
        if (is_null($existUser)) {
            $user = new User();
            $user->student_id = $user_portal->user['studentId'];
            $user->name_zh = $user_portal->user['chineseName'];
            $user->name_en = $user_portal->user['englishName'];
            $user->email = $user_portal->user['email'];
            $user->phone = $user_portal->user['mobilePhone'] ?? null;
            $user->personal_id = $user_portal->user['personalId'];
            $user->gender = $user_portal->user['gender'];
            $user->login_method = LoginMethod::PORTAL;
            $user->create_user = Common::SYSTEM_USER;
            $user->modify_user = Common::SYSTEM_USER;
            $user->save();
            Auth::login($user);
        } else {
            // 之前登入的人若沒有寫入以下資料，要重新寫入
            $existUser->personal_id = $existUser->personal_id ?? $user_portal->user['personalId'];
            $existUser->gender = $existUser->gender ?? $user_portal->user['gender'];
            $existUser->login_method = $existUser->login_method ?? LoginMethod::PORTAL;
            $existUser->save();
            Auth::login($existUser);
        }

        if (session()->has('previous_page')) {
            $url = session('previous_page');
            session()->forget('previous_page');
            return redirect()->intended($url);
        }

        return redirect()->route('index');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        // 將目前使用者登出
        Auth::logout();

        return redirect()->intended(url()->previous());
    }
}
