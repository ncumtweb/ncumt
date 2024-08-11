<?php

namespace App\Http\Livewire\Conference;

use App\Models\ConferenceUser;
use Livewire\Component;

class Search extends Component
{
    public $conferenceUser;

    public $email;

    protected array $rules = [
        'email' => 'required|email',
    ];

    public array $messages = [
        'email.required' => 'Email 為必填',
        'email.email' => 'Email 格式錯誤',
    ];

    public function submit(): void
    {
        $this->validate();

        $this->conferenceUser = ConferenceUser::where('email', $this->email)->first();
        if (!$this->conferenceUser) {
            $this->addError('email', '查無此 email 的報名資訊');
            return;
        }
        session()->flash('status', '查詢成功！');
        $this->emit('userSelected', $this->conferenceUser->id);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.conference.search');
    }
}
