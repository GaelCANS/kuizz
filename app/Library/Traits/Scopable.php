<?php

namespace App\Library\Traits;

/**
 * Created by PhpStorm.
 * User: gaellevant
 * Date: 19/02/2018
 * Time: 14:20
 */
trait Scopable
{

    public function scopeNotdeleted( $query ) {
        return $query->where('delete' , '0');
    }

}