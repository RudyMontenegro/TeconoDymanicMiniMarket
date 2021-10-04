<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venta extends Model
{
    public static function getNit($id){
        $nit = DB::table('clientes') 
        ->select('nit')
        ->where('nombre','=',$id)
        ->get();
        return $nit;
    } 
 

    public static function ventaXsucursal(){ 
        $VentasSucursales = DB::table('ventas')
        ->Join('sucursals','sucursals.id', '=', 'ventas.id_sucursal')
        ->select('ventas.id','ventas.cliente','ventas.nit','ventas.fecha'
        ,'ventas.tipo_venta','sucursals.nombre','ventas.total','ventas.responsable_venta'
        ,'ventas.comprobante','ventas.observaciones'
        )
        ->get();
        //dd($Ven
        return $VentasSucursales;
    } 
}
