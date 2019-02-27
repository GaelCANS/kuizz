<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuizzRequest extends Request
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
        // Question
        $question = $this->questionRules();
        $answer = $this->answerRules();
        $quizz = $this->quizzRules();

        return array_merge(
            $quizz,
            $question,
            $answer
        );
    }

    private function questionRules()
    {
        $rules = array();

        if ($this->input('question.update')!=null) {
            foreach ($this->input('question.update') as $item => $question) {
                $rules["question.update.{$item}.wording"]       = array('required','string');
                $rules["question.update.{$item}.order"]         = array('required' , 'integer');
                $rules["question.update.{$item}.comment"]       = array('string');
                $rules["question.update.{$item}.response"]      = array('string');
            }
        }

        return $rules;
    }

    private function answerRules()
    {
        $rules = array();

        if ($this->input('answer.update')!=null) {
            foreach ($this->input('answer.update') as $item => $question) {
                $rules["answer.update.{$item}.wording"]       = array('required','string');
                $rules["answer.update.{$item}.order"]         = array('required' , 'integer');
                $rules["answer.update.{$item}.good"]          = array('required' , 'boolean');
            }
        }

        return $rules;
    }

    private function quizzRules()
    {
        return array(
            'name'           => 'required|string',
            'comment'        => 'string',
            "template_id"    => "required|exists:templates,id",
            'timing'         => 'integer',
            'single_rseponse'=> 'boolean',
            'ca_only'        => 'boolean',
            'regame'         => 'boolean',
            'intro'          => 'string',
            'response_delay' => 'numeric'
        );
    }
}
