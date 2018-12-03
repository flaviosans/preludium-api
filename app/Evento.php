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

    public static function eventos($num = 10, $tempo, $q = ''){
        $eventos = '';
        if($tempo == 'anteriores')
            $eventos = self::anteriores($num, $q);
        else
            $eventos = self::proximos($num, $q);
        return $eventos->get();
    }

    private static function anteriores($num = 100, $q = ''){
        $evento = Evento::where([
            ['user_id', '=', Auth::id()],
            ['data', '<', new Carbon('today')],
        ]);
        $evento = self::refinar($evento, $q);
        $evento = $evento->orderBy('data');

        return $evento;
    }

    private static function proximos($num = 100, $q = ''){
        $evento = Evento::where([
            ['user_id', '=', Auth::id()],
            ['data', '>', new Carbon('yesterday')],
        ]);
        $evento = self::refinar($evento, $q);
        $evento = $evento->orderBy('data');

        return $evento;
    }

    private static function refinar($evento, $q){
        $q = '%' . $q . '%';
        return $evento->where('titulo', 'like', $q);
            // ->orWhere('descricao', 'like', $q)
            // ->orWhere('data', 'like', $q);
    }
}
