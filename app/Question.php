<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = array('id');


    public static function saveQuestions($questions)
    {
        $questions = $questions['question'];
        // Update
        if (isset($questions['update'])) {
            foreach ($questions['update'] as $question_id => $question_datas) {
                $question = self::findOrFail($question_id);
                $question->update($question_datas);
            }
        }

        // Save
        if (isset($questions['create'])) {
            foreach ($questions['update'] as $question_id => $question_datas) {
                $question = self::create($question_datas);
            }
        }
    }

    // 1 to 1
    public function quizz() {
        return $this->belongsTo('App\Quizz');
    }

    // 1 to many
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

}
