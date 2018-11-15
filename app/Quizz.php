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
        return $this->hasMany('App\Question')->where('delete',0)->orderBy('order' , 'ASC');
    }

    // 1 to 1
    public function template()
    {
        return $this->belongsTo('App\Template');
    }
}
