<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    }


    public static function hasAnswered($answer_id,$user_id)
    {
        return DB::table('answer_user')->whereAnswerId($answer_id)->whereUserId($user_id)->count() > 0 ? true : false;
    }

    public static function percentAnswered($answer_id, $question_id)
    {

        $question = Question::findOrFail($question_id);
        $question->load('Users');
        $printed = $question->users()->count();
        $answered = DB::table('answer_user')->whereAnswerId($answer_id)->count();
        return round(($answered*100)/$printed);
    }

    // 1 to 1
    public function question() {
        return $this->belongsTo('App\Question');
    }

    // many to many
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
