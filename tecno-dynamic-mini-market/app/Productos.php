<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
    public static function producto($id){
        $persona = DB::table('productos') 
        ->select('*')
        ->where('id_sucursal','=',$id)
        ->get();
        return $persona;
    } 

    function numRows($nombre,$sucursal) {
        $result  = DB::table('productos')
                    ->where('nombre','=', $nombre)
                    ->where('id_sucursal','=', $sucursal)
                    ->count();
        return $result;
    }
    function cuenta($nombre) {
        $result  =  strlen($nombre);
        return $result;
    }
    function existe($codigo,$sucursal,$id) {
        $result  = DB::table('productos')
                    ->where('id','<>', $id)
                    ->where('nombre','=', $codigo)
                    ->where('id_sucursal','=', $sucursal)
                    ->exists();
        return $result;
    }

    function numRows2($nombre,$sucursal) {
        $result  = DB::table('productos')
                    ->where('codigo','=', $nombre)
                    ->where('id_sucursal','=', $sucursal)
                    ->count();
        return $result;
    }
    function existe2($codigo,$sucursal,$id) {
        $result  = DB::table('productos')
                    ->where('id','<>', $id)
                    ->where('codigo','=', $codigo)
                    ->where('id_sucursal','=', $sucursal)
                    ->exists();
        return $result;
    }

    function numRows3($nombre,$sucursal) {
        $result  = DB::table('productos')
                    ->where('codigo_barra','=', $nombre)
                    ->where('id_sucursal','=', $sucursal)
                    ->count();
        return $result;
    }

    function existe3($codigo,$sucursal,$id) {
        $result  = DB::table('productos')
                    ->where('id','<>', $id)
                    ->where('codigo_barra','=', $codigo)
                    ->where('id_sucursal','=', $sucursal)
                    ->exists();
        return $result;
    }
    public static function codigo($id){
        $persona2 = DB::table('productos') 
        ->select('*')
        ->where('codigo','=',$id)
        ->get();
        return $persona2;
    }
    public static function nombres($id){
        $nombre = DB::table('productos') 
        ->select('nombre','unidad','precio_venta_menor')
        ->where('codigo_barra','=',$id)
        ->get();
        return $nombre;
    }
    public static function nombres2($id){
        $nombre = DB::table('productos') 
        ->select('codigo_barra','unidad','precio_venta_menor')
        ->where('nombre','=',$id)
        ->get();
        return $nombre;
    }

    public static function busqueda($id){
        $nombre = DB::table('productos') 
                    ->join('categorias', 'categorias.id', '=', 'productos.id_categoria')
                    ->select('categorias.nombre as categoria','productos.codigo_barra','productos.nombre','productos.id')
                    ->where('productos.id_sucursal','=',$id)
                    ->get();
        return $nombre;
    }
    public static function existe4($codigo,$sucursal){
        $nombre = DB::table('productos')
                ->select('nombre')
                ->where('codigo_barra','=',$codigo)
                ->where('id_sucursal','=',$sucursal)
                ->exists();
        return $nombre;
    }

    function existeCodigoBarra($codigo,$sucursal){
        $nombre = DB::table('productos')
                ->select('nombre')
                ->where('codigo_barra','=',$codigo)
                ->where('id_sucursal','=',$sucursal)
                ->exists();
        return $nombre;
    }
} 