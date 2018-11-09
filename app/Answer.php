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
            foreach ($answers['update'] as $answer_id => $answerdatas) {
                $answer = self::create($answer_datas);
            }
        }
    }

    // 1 to 1
    public function question() {
        return $this->belongsTo('App\Question');
    }
}
