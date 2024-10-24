<?php

namespace App\Http\Livewire\Conference;

use App\Enums\Identity;
use App\Enums\Mode;
use App\Mail\Conference\ConferenceRegister;
use App\Models\ConferenceUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Form extends Component
{

    public $mode;
    public $conferenceUser;

    public bool $isDone = false;

    public $name;
    public $phone;
    public $gender;
    public $isVegetarian;
    public $email;
    public $identity;
    public $schoolName;
    public $department;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'isVegetarian' => 'required|boolean',
        'gender' => 'required|in:1,2',
        'phone' => 'required|digits:10',
        'email' => 'required|email|max:255',
        'identity' => 'required|in:student,social',
    ];

    public array $messages = [
        'name.required' => '姓名為必填',
        'isVegetarian.required' => '是否吃素為必填',
        'phone.required' => '手機為必填',
        'phone.digits' => '手機格式錯誤',
        'gender.required' => '性別為必填',
        'email.required' => 'Email 為必填',
        'email.email' => 'Email 格式錯誤',
        'identity.required' => '身份為必填',
        'schoolName.required' => '校名為必填',
        'department.required' => '系級為必填',
    ];

    protected $listeners = [
        'userSelected' => 'handleUserSelected',
    ];

    public function handleUserSelected($conferenceUserId): void
    {
        $this->conferenceUser = ConferenceUser::findOrFail($conferenceUserId);
        $this->name = $this->conferenceUser->name;
        $this->phone = $this->conferenceUser->phone;
        $this->gender = $this->conferenceUser->gender;
        $this->isVegetarian = $this->conferenceUser->is_vegetarian;
        $this->email = $this->conferenceUser->email;
        $this->identity = $this->conferenceUser->identity;
        $this->schoolName = $this->conferenceUser->school_name;
        $this->department = $this->conferenceUser->department;
        $this->isDone = false;
    }

    /**
     * 若身份為學生，則增加校名與系級必填的規則
     *
     * @param $identity
     * @return void
     */
    public function updateRuleByIdentity($identity): void
    {
        if ($identity == Identity::STUDENT->value) {
            $this->rules['schoolName'] = 'required|string|max:255';
            $this->rules['department'] = 'required|string|max:255';
        } else {
            unset($this->rules['schoolName']);
            unset($this->rules['department']);
        }
    }

    public function submit(): void
    {
        $this->updateRuleByIdentity($this->identity);
        $this->validate();

        if (Mode::CREATE == $this->mode || (Mode::EDIT == $this->mode && !$this->isOriginalEmail())) {
            $existingUser = ConferenceUser::where('email', $this->email)->first();
            if ($existingUser) {
                $this->addError('email', '此電子郵件已註冊過');
                return;
            }
        }

        $conferenceUser = $this->saveConferenceUser();
        $this->sendSuccessEmail($conferenceUser);

        if (Mode::CREATE == $this->mode) {
            $registerOrEdit = '送出';
            $this->reset();
            $this->mode = Mode::CREATE;
        } else {
            $registerOrEdit = '修改';
        }

        $successMessage = '成功' . $registerOrEdit . '報名資訊！已將您的報名資訊寄送至您的信箱，請確認您的信箱。';
        $this->isDone = true;
        session()->flash('status', $successMessage);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.conference.form');
    }

    private function isOriginalEmail(): bool
    {
        return $this->conferenceUser->email == $this->email;
    }

    /**
     * 儲存或是編輯 conferenceUser
     *
     * @return ConferenceUser
     */
    private function saveConferenceUser(): ConferenceUser
    {
        $conferenceUser = Mode::CREATE == $this->mode ? new ConferenceUser() : $this->conferenceUser;

        $conferenceUser->name = $this->name;
        $conferenceUser->is_vegetarian = $this->isVegetarian;
        $conferenceUser->gender = $this->gender;
        $conferenceUser->phone = $this->phone;
        $conferenceUser->email = $this->email;
        $conferenceUser->identity = $this->identity;

        // 若更新成 SOCIAL 校名與系級要設為空
        if (Identity::SOCIAL->value == $this->identity) {
            $conferenceUser->school_name = null;
            $conferenceUser->department = null;
        } else {
            $conferenceUser->school_name = $this->schoolName;
            $conferenceUser->department = $this->department;
        }

        $conferenceUser->save();
        return $conferenceUser;
    }

    /**
     * 發送報名或是編輯成功的 email
     *
     * @param ConferenceUser $conferenceUser
     * @return void
     */
    private function sendSuccessEmail(ConferenceUser $conferenceUser): void
    {
        Mail::to($conferenceUser->email)->queue(new ConferenceRegister($conferenceUser, $this->mode));
        Log::info('send conference register email to ' . $conferenceUser->email . ', mode: ' . $this->mode->value);
    }

    public function cancelRegistration()
    {
        if (!$this->conferenceUser) {
            return redirect()->route('conference.search')->with('status', '無法取消報名，請確認您的報名資訊是否正確');
        }

        $userName = $this->conferenceUser->name;
        $this->conferenceUser->delete();
        return redirect()->route('conference.register')->with('status', $userName . '，您的報名已取消');
    }
}
