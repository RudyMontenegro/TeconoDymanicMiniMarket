<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    public static function compraXsucursal(){
        $ComprasSucursales = DB::table('compras')
           ->Join('sucursals','sucursals.id','=','compras.id_sucursal')
           ->select('compras.id','compras.comprobante','compras.fecha',
               'compras.tipo_compra','sucursals.nombre','compras.total',
               'compras.responsable_compra','compras.observaciones')
          ->get();

        return $ComprasSucursales;
    } 
}
