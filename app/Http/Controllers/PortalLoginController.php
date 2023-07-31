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
        $poisition_index=
            array("110602527"=> 1,"110602537"=> 2, "110501524" => 3, '111802009' => 4, '111302526' =>4, 
            '110303587' => 4, '110202512' => 4, '110605008' => 5, '110502516' => 7 , '111303041' => 8, 
            '110503528' => 8, '111409003'=> 8, '110602517' => 8, '110401035' => 9, '110602512' => 10, '111101514' => 10,
            '111502502' => 11, '' => 12, '110403027' => 13, '109502016' => 14, '110602532' => 15, '10940355' => 16,
            '109602012' => 17, '109303032' => 17
        );
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

        if(is_null($checkExist)) {
            $user = new User();
            $user->id = $user_portal->user['id'];
            $user->identifier = $user_portal->user['identifier'];
            $user->name_zh = $user_portal->user['chineseName'];
            $user->name_en = $user_portal->user['englishName'];
            $user->email = $user_portal->user['email'];
            if(!is_null($user->phone)){
                $user->phone = $user_portal->user['mobilePhone'];
            }                
            
            if(isset($poisition_index[$user_portal->user['identifier']])) {
                $role = $poisition_index[$user_portal->user['identifier']];
                $user->role = $role;
            }
            
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
