<?php

namespace App\Http\Controllers;

use App\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporte.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filtrado()
    {
        $venta = DB::table('ventas')
                    ->join('venta_detalles','venta_detalles.id_venta','ventas.id')
                    ->select('ventas.*','venta_detalles.*')
                    ->where('fecha','>=',request('fecha_inicio'))
                    ->where('fecha','<=',request('fecha_fin'))
                    ->get();

        $compra = DB::table('compras')
                    ->join('compra_detalles','compra_detalles.id_compra','compras.id')
                    ->select('compras.*','compra_detalles.*')
                    ->where('fecha','>=',request('fecha_inicio'))
                    ->where('fecha','<=',request('fecha_fin'))
                    ->get();
        
        return view('reporte.busqueda', compact('venta','compra'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
