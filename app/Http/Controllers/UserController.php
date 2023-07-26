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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name_zh = $request->input('name_zh');
        $user->name_en = $request->input('name_en');
        $user->nickname = $request->input('nickname');
        $user->role = $request->input('position');
        $user->identifier = $request->input('studentID');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->update();

        return redirect()->back()->with('status','個人資料更新成功');
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
}
