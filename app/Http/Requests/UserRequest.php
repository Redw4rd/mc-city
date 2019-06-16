<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'username' => 'required|max:20|alpha_dash',
            'email' => 'required|email',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Felhasználónév',
            'email' => 'E-mail cím'
        ];
    }
}
