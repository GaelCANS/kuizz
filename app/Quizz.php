<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use Scopable;

    protected $guarded = array('id');


    // 1 to many
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
