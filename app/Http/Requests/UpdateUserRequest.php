<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = User::findOrFail($this->route('id'));

        return $this->user()->can('update', $user);
    }

    public function rules(): array
    {
        return [
            'name_zh'  => 'required|string|max:255',
            'name_en'  => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'phone'    => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-() ]+$/'],
            // filter 會擋掉含換行的位址，避免 email header CRLF injection
            'email'    => [
                'required',
                'email:rfc,filter',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name_zh.required' => '請輸入中文姓名',
            'name_en.required' => '請輸入英文姓名',
            'phone.regex'      => '手機號碼格式不正確',
            'email.required'   => '請輸入電子信箱',
            'email.email'      => '電子信箱格式不正確',
            'email.unique'     => '此電子信箱已被使用',
        ];
    }
}
