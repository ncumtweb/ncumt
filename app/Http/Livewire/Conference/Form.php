<?php

namespace App\Http\Livewire\Conference;

use App\Enums\Gender;
use App\Enums\Identity;
use App\Models\ConferenceUser;
use Livewire\Component;

class Form extends Component
{

    public $mode;

    public $name;
    public $isVegetarian;
    public $gender;
    public $phone;
    public $email;
    public $identity;
    public $schoolName;
    public $department;

    protected $rules = [
        'name' => 'required|string|max:255',
        'isVegetarian' => 'required|boolean',
        'gender' => 'required|in:0,1',
        'phone' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'identity' => 'required|in:student,social',
    ];

    public $messages = [
        'name.required' => '姓名為必填',
        'isVegetarian.required' => '是否吃素為必填',
        'phone.required' => '手機為必填',
        'gender.required' => '性別為必填',
        'email.required' => 'Email 為必填',
        'identity.required' => '身份為必填',
        'schoolName.required' => '校名為必填',
        'department.required' => '系級為必填',
    ];

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

    public function submit()
    {
        $this->updateRuleByIdentity($this->identity);
        $this->validate();

        $existingUser = ConferenceUser::where('email', $this->email)->first();

        if ($existingUser) {
            // 如果 email 已经存在，返回错误消息
            $this->addError('email', '此電子郵件已註冊過');
            return;
        }

        $conferenceUser = new ConferenceUser();
        $conferenceUser->name = $this->name;
        $conferenceUser->is_vegetarian = $this->isVegetarian;
        $conferenceUser->gender = $this->gender;
        $conferenceUser->phone = $this->phone;
        $conferenceUser->email = $this->email;
        $conferenceUser->identity = $this->identity;
        $conferenceUser->school_name = $this->schoolName;
        $conferenceUser->department = $this->department;

        // 保存到数据库
        $conferenceUser->save();

        session()->flash('status', '成功提交表單！');

        $this->reset();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.conference.form');
    }
}
