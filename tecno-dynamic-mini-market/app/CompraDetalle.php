<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompraDetalle extends Model
{
    function existe($codigo,$sucursal){

        $nombre = DB::table('productos')
                ->select('nombre')
                ->where('codigo','=',$codigo)
                ->where('id_sucursal','=',$sucursal)
                ->exists();
        return $nombre;
    }
    function aumentarInventario($codigo,$cantidades,$origen){

        $cantidad_origen = DB::table('productos')
                            ->select('cantidad')
                            ->where('id','=', intval($codigo))
                            ->first();
        
        $res = intval($cantidad_origen->cantidad)+$cantidades;

        DB::table('productos')
        ->where('id',  intval($codigo))
        ->where('id_sucursal', $origen)
        ->update(['cantidad' => $res]);
    }
}
