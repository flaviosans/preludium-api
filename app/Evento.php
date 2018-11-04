<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Evento extends Model
{
    use SoftDeletes;

    protected $fillable = [
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

    public static function proximos($num = 10){
        $evento = Evento::where('user_id', '=', Auth::id())->get();

        return $evento;
    }
}
