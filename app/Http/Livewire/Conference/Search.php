<?php

namespace App\Http\Livewire\Conference;

use App\Mail\VerificationCodeMail;
use App\Models\ConferenceUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Search extends Component
{
    public $conferenceUser;

    public $originEmail = null;

    public $email;

    public bool $isValid = false;

    public int $verificationCode;
    public $verificationCodeInput;
    public $verificationCodeCreatedAt;
    public bool $isVerificationCodeUsed = false;

    public $lastSentAt;
    public int $resendCoolDown = 30;

    protected array $rules = [
        'email' => 'required|email',
    ];

    public array $messages = [
        'email.required' => 'Email 為必填',
        'email.email' => 'Email 格式錯誤',
    ];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.conference.search');
    }

    public function mount()
    {
        $this->lastSentAt = null;
    }

    public function submit(): void
    {
        $this->validate();
        // 若重複查詢相同的信箱，要先判斷 30 秒內是否有發過驗證碼
        if ($this->originEmail == $this->email) {
            if (!$this->hasSendVerification()) {
                $this->sendVerificationCodeToUser();
                session()->flash('status', '查詢成功，已將驗證碼寄到您的信箱，請確認您的信箱，並於下方輸入驗證碼。');
            }
            return;
        }
        $this->conferenceUser = ConferenceUser::where('email', $this->email)->first();
        if (!$this->conferenceUser) {
            $this->addError('email', '查無此 email 的報名資訊');
            return;
        }
        $this->originEmail = $this->email;
        $this->sendVerificationCodeToUser();
        session()->flash('status', '查詢成功，已將驗證碼寄到您的信箱，請確認您的信箱，並於下方輸入驗證碼。');
    }

    private function sendVerificationCodeToUser(): void
    {
        $this->verificationCode = rand(100000, 999999);
        $this->verificationCodeCreatedAt = now();
        $this->isVerificationCodeUsed = false;
        $subject = '「第二十五屆全國大專校院登山運動研討會」報名資料查詢驗證';
        Mail::to($this->email)->queue(new VerificationCodeMail($subject, $this->verificationCode));
        $this->lastSentAt = Carbon::now();
    }

    public function resendVerificationCodeToUser(): void
    {
        if (!$this->hasSendVerification()) {
            $this->sendVerificationCodeToUser();
            session()->flash('status', '重新寄送成功，已重新寄送驗證碼到您的信箱，請確認您的信箱，並於下方輸入驗證碼。');
        }
    }

    /**
     * 判斷驗證碼是否在 30 秒內重複寄出
     *
     * @return bool
     */
    private function hasSendVerification(): bool
    {
        $now = Carbon::now();
        $remainTime = $this->resendCoolDown - $now->diffInSeconds($this->lastSentAt);
        if ($this->lastSentAt && $now->diffInSeconds($this->lastSentAt) < $this->resendCoolDown) {
            session()->forget('status');
            session()->flash('warning', '請稍等 ' . $remainTime . ' 秒後，再點選重新寄送驗證碼。');
            return true;
        }
        return false;
    }

    /**
     * 比對輸入的驗證碼是否正確，
     *
     * @return void
     */
    public function submitVerificationCode(): void
    {
        if ($this->verificationCodeInput != $this->verificationCode) {
            session()->forget('status');
            session()->flash('warning', '驗證碼錯誤，請重試。');
            $this->isValid = false;
            return;
        }

        if ($this->isVerificationCodeUsed) {
            session()->forget('status');
            session()->flash('warning', '驗證碼已失效，請重試。');
            $this->isValid = false;
            return;
        }

        if (now()->diffInMinutes($this->verificationCodeCreatedAt) > 5) {
            session()->forget('status');
            session()->flash('warning', '驗證碼已失效，請重試。');
            $this->isValid = false;
            return;
        }

        $this->isVerificationCodeUsed = true;
        session()->flash('status', '驗證碼正確，請確認您的報名資訊。');
        $this->emit('userSelected', $this->conferenceUser->id);
        $this->isValid = true;
    }
}
