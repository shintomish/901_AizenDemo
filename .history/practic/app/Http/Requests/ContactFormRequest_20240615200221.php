<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 今回はログインなどがないため、authorizeをtrueにします。
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'      => ['required', 'string', 'max:30'],
            // 'name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ロワンヴー]*$/u'],
            'phone'     => ['nullable', 'regex:/^0(\\d-?\\d{4}|\\d{2}-?\\d{3}|\\d{3}-?\\d{2}|\\d{4}-?\\d|\\d0-?\\d{4})-?\\d{4}$/'],
            'email'     => ['required', 'email:strict,spoof,filter,dns', 'max:254', 'confirmed'],
            'email_confirmation'     => ['required', 'email:strict,spoof,filter,dns', 'max:254'],
            'body'      => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * 属性名
     */
    public function attributes()
    {
        //
        return [
            'company'               => '会社名',
            'name'                  => '名前',
            'name_kana'             => 'フリガナ',
            'phone'                 => '電話番号',
            'email'                 => 'メールアドレス',
            'email_confirmation'    => 'メールアドレスの確認',
            'body'                  => 'お問い合わせ内容'

        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        //
        return [
            'phone.regex'   => ':attributeが正しくありません。'
        ];
    }
}
