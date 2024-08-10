<?php

namespace App\Http\Livewire\Conference;

use App\Models\ConferenceUser;
use Livewire\Component;

class Search extends Component
{
    public $conferenceUser;

    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public $messages = [
        'email.required' => 'Email 為必填',
    ];

    public function submit(): void
    {
        $this->validate();

        $this->conferenceUser = ConferenceUser::where('email', $this->email)->first();
        if (!$this->conferenceUser) {
            // 如果没有找到匹配的记录
            $this->addError('email', '查無此 email 的報名資訊');
        }
        session()->flash('status', '查詢成功！');
        $this->emit('userSelected', $this->conferenceUser->id);
    }

    public function render()
    {
        return view('livewire.conference.search');
    }
}
