<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = array('id');

    public function getSlugAttribute()
    {
        return str_slug($this->name);
    }

    public static function getGrade($template, $score_percent)
    {
        return Grade::whereTemplateId($template->id)->where('step','<=',$score_percent)->orderBy('step','DESC')->first();
    }
}
