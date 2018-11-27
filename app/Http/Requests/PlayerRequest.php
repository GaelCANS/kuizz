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
            'email'         => 'required|email'.(session('quizz')->ca_only ? '|regex:^[a-z0-9](\.?[a-z0-9]){3,}@ca-normandie-seine\.fr$^' : '').(session('quizz')->regame == 0 ? '|regame:'.session('quizz')->id : '')
        );

        return $return;
    }

    public function messages()
    {
        return array(
            'email.regex' => "Seul les emails CANS sont autorisés pour ce quizz",
            'email.regame' => "Vous ne pouvez pas participer à nouveau à ce quizz",
        );
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
