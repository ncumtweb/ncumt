<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected string $paginationTheme = 'bootstrap';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request): View
    {
        $page = $request->input('page', 1);
        $users = User::orderBy('created_at', 'desc')->paginate(10)->appends(['page' => $page]);
        $request->session()->forget('page');
        return view('user.userList', compact('users'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        //avoid url attack
        if(!$this->checkUser($id)) {
            return redirect()->route('index');
        }
        return view('user.information', compact('user'));
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

        return(view('user.edit', compact('user')));
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
        // if ($user->role) {
        //     $user->role = $request->input('position');
        // }
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

    public function updateRole(Request $request, int $userId): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($userId);
        $user->role = $request->role;
        $user->save();

        $page = $request->input('page', 1);
        return redirect()->route('user.list', ['page' => $page])->with('status', $user->name_zh . '的角色更新成功');
    }
}
