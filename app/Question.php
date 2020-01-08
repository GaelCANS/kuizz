<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Question extends Model
{

    use Scopable;

    protected $guarded = array('id');


    public function displayOrder($quizz)
    {
        return $quizz->howmuch > 0 ? session('cursor') : $this->order;
    }

    public function isLast($quizz)
    {
        if ($quizz->howmuch > 0) {
            $cursor = session('cursor');
            return $cursor != $quizz->howmuch;
        }
        return $this->order != $quizz->questions->count();
    }

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
    }

    public static function getScore($question , $answers)
    {
        // Récupération des bonnes réponses
        $goods = Answer::whereQuestionId($question->id)->whereGood(1)->pluck('id')->toArray();

        // Si différence entre les questions et les réponses retourne erreur
        if (count($answers) != count($goods)) return 0;

        // Sinon on compare les deux tableaux
        return count(array_diff($answers,$goods)) == 0 ? 1 : 0;
    }

    public static function nextQuestion($question)
    {
        if ($question->quizz->shuffle == 0) {
            return Question::where('quizz_id',$question->quizz_id)->notdeleted()->whereOrder($question->order+1)->first();
        }
        else {
            $order = session('order');
            $cursor = session('cursor');
            if (!isset($order[$cursor])) return null;
            $question = Question::findOrFail($order[$cursor]);
            $cursor = session(array('cursor' => $cursor+1));
            return $question;
        }
    }

    // 1 to 1
    public function quizz() {
        return $this->belongsTo('App\Quizz');
    }

    // 1 to many
    public function answers()
    {
        return $this->hasMany('App\Answer')->where('delete',0)->orderBy('order' , 'ASC');
    }

    // many to many
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
