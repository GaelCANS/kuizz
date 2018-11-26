<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlayerRequest extends Request
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
        $return = array(
            'name'          => 'required|string',
            'email'         => 'required|email'.(session('quizz')->ca_only ? '|regex:^[a-z0-9](\.?[a-z0-9]){5,}@ca-normandie-seine\.fr$^' : '')
        );

        return $return;
    }
}
