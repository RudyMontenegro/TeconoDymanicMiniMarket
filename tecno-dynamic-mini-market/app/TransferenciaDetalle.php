<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransferenciaDetalle extends Model
{
  

    function existe($codigo,$sucursal){

        $nombre = DB::table('productos')
                ->select('nombre')
                ->where('codigo','=',$codigo)
                ->where('id_sucursal','=',$sucursal)
                ->exists();
        return $nombre;
    }

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

    function aumentarInventario($codigo,$cantidades,$destino){

        $cantidad_destino = DB::table('productos')
                            ->select('cantidad')
                            ->where('id','=',$codigo)
                            ->first();

        $res2 = intval($cantidad_destino->cantidad)+$cantidades;

        DB::table('productos')
        ->where('id', $codigo)
        ->where('id_sucursal', $destino)
        ->update(['cantidad' => $res2]);
    }

    function cantidadActual($codigo,$sucursal){
        $res = DB::table('productos')
                ->select('cantidad')
                ->where('codigo','=',$codigo)
                ->where('id_sucursal','=',$sucursal)
                ->first();
        return $res->cantidad;
    }

}
