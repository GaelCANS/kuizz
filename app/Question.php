<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    use Scopable;

    protected $guarded = array('id');


    public static function saveQuestions($questions , $quizz_id)
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
            foreach ($questions['create']['wording'] as $question_id => $question_datas) {

                if ( trim($questions['create']['wording'][$question_id]) != '') {
                    $question_value = array(
                        'wording' => $questions['create']['wording'][$question_id],
                        'order' => $questions['create']['order'][$question_id],
                        'quizz_id' => $quizz_id
                    );
                    $question = self::create($question_value);
                }
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
        return $this->hasMany('App\Answer')->where('delete',0);
    }

}
