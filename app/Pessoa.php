<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user(){
      return $this->hasOne('App\User');
    }

    public function eventos(){
      return $this->belongsToMany('App\Evento');
    }
}
