<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class PortalLoginController extends Controller
{
    public function redirectToProvider()
    {
        return \Socialite::with('portal')->redirect();
    }

    public function handleProviderCallback()
    {
        $user_portal = \Socialite::with('portal')->stateless()->user();


        // Portal 回傳欄位說明 (2022.12.13)
        // $user->user['id']: portal 唯一識別碼
        // $user->user['identifier']: 學號
        // $user->user['chineseNase']: 中文姓名
        // $user->user['englishName']: 英文姓名
        // $user->user['email']: 信箱
        // $user->token: 使用者 token
        
        $checkExist = User::where('id', $user_portal->user['id'])->first();

        if(is_null($checkExist)) {
            $user = new User();
            $user->id = $user_portal->user['id'];
            $user->identifier = $user_portal->user['identifier'];
            $user->name_zh = $user_portal->user['chineseName'];
            $user->name_en = $user_portal->user['englishName'];
            $user->email = $user_portal->user['email'];
            $user->phone = $user_portal->user['mobilePhone'];
            $user->role = 1;
            $user->save();

            $checkExist = User::where('id', $user_portal->user['id'])->first(); // 指向不成功，所以再查一次
        }
        Auth::login($checkExist);
        return redirect()->route('index');
    }

    public function logout()
    {
        // 將目前使用者登出
        Auth::logout();

        return redirect()->route('index');
    }
}
