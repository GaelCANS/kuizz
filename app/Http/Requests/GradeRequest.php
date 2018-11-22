<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GradeRequest extends Request
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
        $rules = array();

        if ($this->input('grade')!=null) {
            foreach ($this->input('grade') as $item => $grade) {
                $rules["grade.{$item}.name"]       = array('required','string');
                $rules["grade.{$item}.step"]       = array('required' ,'string');
            }
        }

        return $rules;
    }
}
