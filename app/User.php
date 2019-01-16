<?php

namespace App;

use App\Library\Traits\Scopable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Scopable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin' , 'quizz_id' , 'agency_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Scope "admin"
     *
     * @param $query
     * @return mixed
     */
    public function scopeAdmin( $query ) {
        return $query->where('admin' , '1');
    }

    public function getFullnameAttribute() {
        return $this->name;
    }

    public function getSendedAttribute() {
        return $this->sended_at == '0000-00-00 00:00:00' ? false : true;
    }

    // many to many
    public function answers()
    {
        return $this->belongsToMany('App\Answer')->withTimestamps();
    }

    // many to many
    public function questions()
    {
        return $this->belongsToMany('App\Question')->withTimestamps();
    }

    // 1 to many
    public function agency()
    {
        return $this->belongsTo('App\Agency');
    }
}
