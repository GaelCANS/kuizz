<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    use Scopable;

    protected $guarded = array('id');


    public static function saveAnswers($answers)
    {
        $answers = $answers['answer'];
        // Update
        if (isset($answers['update'])) {
            foreach ($answers['update'] as $answer_id => $answer_datas) {
                $answer = self::findOrFail($answer_id);
                $answer->update($answer_datas);
            }
        }

        // Save
        if (isset($answers['create'])) {
            foreach ($answers['create']['wording'] as $answer_id => $answer_datas) {

                if ((int)$answers['create']['question_id'][$answer_id] > 0 && trim($answers['create']['wording'][$answer_id]) != "" ) {
                    $answer_value = array(
                        'wording' => $answers['create']['wording'][$answer_id],
                        'question_id' => $answers['create']['question_id'][$answer_id],
                    );
                    $answer = self::create($answer_value);
                }

            }
        }
    }

    // 1 to 1
    public function question() {
        return $this->belongsTo('App\Question');
    }
}
