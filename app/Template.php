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
}
