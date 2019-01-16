<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $guarded = array('id');

    // 1 to many
    public function users()
    {
        return $this->hasOne('App\User');
    }

}
