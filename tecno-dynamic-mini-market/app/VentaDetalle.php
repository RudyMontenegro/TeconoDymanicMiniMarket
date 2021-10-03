<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VentaDetalle extends Model
{
    function reducirInventario($codigo,$cantidades,$origen){

        $cantidad_origen = DB::table('productos')
                            ->select('cantidad')
                            ->where('codigo_barra','=',$codigo)
                            ->first();
        
        $res = intval($cantidad_origen->cantidad)-$cantidades;

        DB::table('productos')
        ->where('codigo_barra', $codigo)
        ->where('id_sucursal', $origen)
        ->update(['cantidad' => $res]);
    }
}
