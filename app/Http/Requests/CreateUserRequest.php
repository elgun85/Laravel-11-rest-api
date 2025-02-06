<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Mail\Events\MessageSent;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'name' => 'required|string|min:3|max:250',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|string|min:6|max:250',
        ];
    }
    public function messages()
    {
        return [
        'name.required' => 'Ad mütləqdir',
        'name.string' => 'Ad mətn tipində olmalıdır',
        'name.min' => 'Ad ən azı 3 simvoldan ibarət olmalıdır',
        'name.max' => 'Ad ən çoxu 250 simvoldan ibarət ola bilər',
        'email.required' => 'Email mütləqdir',
        'email.email' => 'Email düzgün formatda olmalıdır',
        'email.unique' => 'Bu email artıq mövcuddur',
        'password.required' => 'Şifrə mütləqdir',
        'password.string' => 'Şifrə mətn tipində olmalıdır',
        'password.min' => 'Şifrə ən azı 6 simvoldan ibarət olmalıdır',
        'password.max' => 'Şifrə ən çoxu 250 simvoldan ibarət ola bilər',
        ];
    }
}
