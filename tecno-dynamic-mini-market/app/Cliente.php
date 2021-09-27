<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    function numRows($nit) {
        $result  = DB::table('clientes')
                    ->where('nit','=', $nit)
                    ->count();
        return $result;
    }
    function cuenta($nit) {
        $result  =  strlen($nit);
        return $result;
    }
    public static function getCliente($id){
        $cliente = DB::table('clientes') 
        ->select('nombre_contacto')
        ->where('nit','=',$id)
        ->get();
        return $cliente;
    }
    public static function getIdCliente($id){
        $cliente = DB::table('clientes') 
        ->select('id')
        ->where('nit','=',$id)
        ->get();
        return $cliente;
    }
}
