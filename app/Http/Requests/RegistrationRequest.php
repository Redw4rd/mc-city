<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
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
        return [
           'username'      => 'required|unique:users|alpha_dash|max:20|min:4',
            'email'         => 'required|unique:users|email|max:255',
            'email_re'      => 'required|same:email',
            'password'      => 'required|min:6',
            'password_re'   => 'required|same:password',
            'over_13'       => 'accepted',
            'aszf_accept'   => 'accepted',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Felhasználónév',
            'email' => 'E-mail cím',
            'email_re' => 'E-mail cím megerősítés',
            'password' => 'Jelszó',
            'password_re' => 'Jelszó megerősítése',
            'over_13' => 'Elmúltam 13 éves',
            'g-recaptcha-response' => 'Ellenőrző kód',
            'aszf_accept' => 'ASZF, AFF, Szabályzat'
        ];
    }
}
