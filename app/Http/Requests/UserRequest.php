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
        $route = \Request::route()->getName();


        $return = array(
            'name'          => 'required|string'
        );

        $password = $this->input('password');

        if (gettype($password) == "string"){
            $return['password'] = 'min:6|confirmed';
        }
        else {
            $return ['admin'] = 'required|boolean';
        }

        if ($this->input('email') != null) {
            $return['email']    = 'required|email';

        }

        return $return;
    }
}
