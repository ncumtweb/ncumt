<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $users;

    protected $listeners = [
        'roleChanged',
    ];

    public function mount()
    {
        $this->users = User::orderBy('created_at','asc')->get();
    }

    public function roleChanged($userId, $role): void
    {
//        $user = User::findOrFail($userId);
//        $user->role = $role;
//        $user->save();
//
//        session()->flash('status', $user->name_zh . '的角色更新成功');
//        $this->mount();
    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.user-list');
    }
}
