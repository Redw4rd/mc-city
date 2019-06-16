<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PasswordResetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (isset($this->email)) {
            return [
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|recaptcha',
            ];
        } else {
            return [
                'password' => 'required|min:6',
                'password_re' => 'required|same:password'
            ];
        }
    }

    public function attributes()
    {
        return [
            'email' => 'E-mail cím',
            'g-recaptcha-response' => 'Ellenőrző kód',
            'password' => 'Jelszó',
            'password_re' => 'Jelszó megerősítés'
        ];
    }
}
