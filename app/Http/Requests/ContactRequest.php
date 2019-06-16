<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:30',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Név',
            'email' => 'E-mail cím',
            'message' => 'Üzenet',
            'g-recaptcha-response' => 'Ellenőrző kód'
        ];
    }
}
