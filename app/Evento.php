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

    public static function proximos($num = 100, $mes = 0, $q = ''){
        $evento = Evento::where([
            ['user_id', '=', Auth::id()],
            ['data', '>', new Carbon('yesterday')],
            ['data', '<', new Carbon('next year')],
        ]);
        if($mes > 0 && $mes < 13){
            $evento = $evento->whereMonth('data', $mes);
        }
        $evento = self::refinar($evento, $q);
        $evento = $evento->orderBy('data')->take($num)->get();

        return $evento;
    }

    public static function anteriores($num = 100, $mes = 0, $q = ''){
        $evento = Evento::where([
            ['user_id', '=', Auth::id()],
            ['data', '<', new Carbon('tomorrow')],
            ['data', '>', new Carbon(('last year'))],

        ]);
        if($mes > 0 && $mes < 13){
            $evento = $evento->whereMonth('data', $mes);
        }
        $evento = self::refinar($evento, $q);
        $evento = $evento->orderBy('data')->take($num)->get();

        return $evento;
    }

    public static function eventos($num = 10, $mes = 0, $tempo, $q = ''){
        if($tempo == 'anteriores')
            return self::anteriores($num, $mes, $q);
        else
            return self::proximos($num, $mes, $q);
    }

    private static function refinar($evento, $q){
        $q = '%' . $q . '%';
        return $evento->where('titulo', 'like', $q)
            ->orWhere('descricao', 'like', $q)
            ->orWhere('data', 'like', $q);
    }
}
