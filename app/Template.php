<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use Scopable;
    
    protected $guarded = array('id');

    // 1 to many
    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function getScriptEffectAttribute()
    {

        $scripts = array();
        foreach (glob(public_path().'/js/'.$this->texts.'/*.js') as $filename) {
            $scripts[] = $this->texts.'/'.basename($filename);
        }
        return $scripts;
    }

    public function getHtmlEffectAttribute()
    {
        dd();
        $scripts = array();
        foreach (glob(public_path().'/js/'.$this->texts.'/*.js') as $filename) {
            $scripts[] = $this->texts.'/'.basename($filename);
        }
        return $scripts;

        switch ($this->texts) {
            case 'rando':
            case 'assurances':
                return $this->texts;
                break;
            default:
                return '';
                break;
        }
    }
}
