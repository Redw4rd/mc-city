<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TicketCreateRequest extends Request
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
            'message' => 'required|min:30'
        ];
    }

    public function attributes()
    {
        return [
            'message' => 'Üzeneted'
        ];
    }
}
