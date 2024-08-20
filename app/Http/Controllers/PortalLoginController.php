<?php

namespace App\Http\Controllers;

use App\Enums\Common;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function handleProviderCallback()
    {
        $user_portal = \Socialite::with('portal')->stateless()->user();
        // 幹部名單

        // 社員 => 0, 社長 => 1, 副社長 => 2, 嚮導組組長 => 3, 嚮導組組員 => 4,
        // 技術組組長 => 5, 技術組組員 => 6, 器材組組長 => 7, 器材組組員 => 8, 醫藥組組長 => 9,
        // 醫藥組組員 => 10, 文書組組長 => 11, 文書組組員 => 12, 美宣 => 13, 網管 => 14,
        // 財務長 => 15, 山防組組長 => 16

        // $position = ["社員", "社長", "副社長", "嚮導組組長", "嚮導組組員",
        // '技術組組長', '技術組組員', '器材組組長', '器材組組員', '醫藥組組長',
        // '醫藥組組員', '文書組組長', '文書組組員', '美宣', '網管',
        // '財務長', '山防組組長' ];

        $checkExist = User::where('id', $user_portal->user['id'])->first();

        if (is_null($checkExist)) {
            $user = new User();
            $user->id = $user_portal->user['id'];
            $user->identifier = $user_portal->user['studentId'];
            $user->name_zh = $user_portal->user['chineseName'];
            $user->name_en = $user_portal->user['englishName'];
            $user->email = $user_portal->user['email'];
            $user->phone = $user->phone ?? $user_portal->user['mobilePhone'];
            $user->personal_id = $user_portal->user['personalId'];
            $user->gender = $user_portal->user['gender'];
            $user->create_user = Common::SYSTEM_USER;
            $user->modify_user = Common::SYSTEM_USER;
            $user->save();

            $checkExist = User::where('id', $user_portal->user['id'])->first(); // 指向不成功，所以再查一次
        }
        Auth::login($checkExist);

        if (session()->has('previous_page')) {
            $url = session('previous_page');
            session()->forget('previous_page');
            return redirect()->intended($url);
        }

        return redirect()->route('index');
    }

    public function logout()
    {
        // 將目前使用者登出
        Auth::logout();

        return redirect()->intended(url()->previous());
    }
}
