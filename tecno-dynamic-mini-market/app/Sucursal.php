<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sucursal extends Model
{

    public static function sucursal($id){
        $persona = DB::table('sucursals') 
        ->select('*')
        ->where('sucursals.id','<>',$id)
        ->get();
        return $persona;
    }

    function numRows($nombre) {
        $result  = DB::table('sucursals')
                    ->where('nombre','=', $nombre)
                    ->count();
        return $result;
    }
    function cuenta($nombre) {
        $result  =  strlen($nombre);
        return $result;
    }
    function existe($nombre) {
        $valida = DB::table('sucursals')
                        ->where('nombre','=',$nombre)
                        ->exists();
        return $valida;
    }
}
