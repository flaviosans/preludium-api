<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Evento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'data',
        'valor',
        'created_at',
        'updated_at'
    ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    function pessoas(){
      return $this->belongsToMany('App\Pessoa');
    }
}
