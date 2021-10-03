<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    function reducirInventario($codigo,$cantidades,$origen){

        $cantidad_origen = DB::table('productos')
                            ->select('cantidad')
                            ->where('id','=',$codigo)
                            ->first();
        
        $res = intval($cantidad_origen->cantidad)-$cantidades;

        DB::table('productos')
        ->where('id', $codigo)
        ->where('id_sucursal', $origen)
        ->update(['cantidad' => $res]);
    }
}
