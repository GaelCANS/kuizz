<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use Scopable;
    
    protected $guarded = array('id');
}
