<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Sucursal;
use App\Transferencia;
use App\TransferenciaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferenciaController extends Controller
{
    public function index()
    {
        $transferencia = Transferencia::all();
        return view('transferencia.index',compact('transferencia'));
    }
    public function create()
    {
        $sucursal = Sucursal::all();
        return view('transferencia.create',compact('sucursal'));
    }

    public function sucursal(Request $request, $id)
    {
        if($request->ajax()){   
            $sucursal=Sucursal::sucursal($id);
            return response()->json( $sucursal);
        }
    }

    public function producto(Request $request, $id)
    {
        if($request->ajax()){
            $producto=Productos::producto($id);
            return response()->json( $producto);
        }
    }

    public function codigo(Request $request, $id)
    {
        if($request->ajax()){
            $codigo=Productos::codigo($id);
            return response()->json( $codigo);
        }
    }

    public function nombre(Request $request, $id)
    {
        if($request->ajax()){
            $codigo=Productos::nombres($id);
            return response()->json( $codigo);
        }
    }

    public function store(Request $request)
    {
        $transferencia = new Transferencia();

        $transferencia->comprobante = request('comprobante');
        $transferencia->responsable_transferencia = request('responsable');
        $transferencia->fecha = request('fecha');
        $transferencia->sucursal_origen = $request->get('sucursal_origen');
        $transferencia->sucursal_destino = $request->get('sucursal_destino');
        
        $transferencia->save();

        $id_transferencia = DB::table('transferencias')
                                ->select('id')
                                ->where('fecha','=',request('fecha'))
                                ->first();
        
        if($request->input('codigoI') && $request->input('nombre') && $request->input('cantidad') && $request->input('unidad') && $request->input('precio') && $request->input('subTotal')){
            $codigo = request('codigoI');
            $nombre = request('nombre');
            $cantidad = request('cantidad');
            $unidad = request('unidad');
            $precio = request('precio');
            $subTotal = request('subTotal');
            for ($i=0; $i < sizeOf($nombre); $i++) { 

                $id_codigo_producto = DB::table('productos')
                                    ->select('id')
                                    ->where('codigo','=',$codigo[$i])
                                    ->first();

                $transferencia_detalle = new TransferenciaDetalle();

                $transferencia_detalle->codigo_producto =  $id_codigo_producto->id;
                $transferencia_detalle->nombre = $nombre[$i];
                $transferencia_detalle->cantidad = $cantidad[$i];
                $transferencia_detalle->unidad = $unidad[$i];
                $transferencia_detalle->precio = $precio[$i];
                $transferencia_detalle->sub_total = $subTotal[$i];
                $transferencia_detalle->id_transferencia = $id_transferencia->id;

                $transferencia_detalle->save();

                $id_codigo_origen = DB::table('productos')
                                    ->select('id')
                                    ->where('codigo','=',$codigo[$i])
                                    ->where('id_sucursal','=',intval($request->get('sucursal_origen')))
                                    ->first();
                $id_codigo_destino = DB::table('productos')
                                    ->select('id')
                                    ->where('codigo','=',$codigo[$i])
                                    ->where('id_sucursal','=',intval($request->get('sucursal_destino')))
                                    ->first();

                $transferencia_detalle->reducirInventario($id_codigo_origen->id,intval($cantidad[$i]),intval($request->get('sucursal_origen')));
                $transferencia_detalle->aumentarInventario($id_codigo_destino->id,intval($cantidad[$i]),intval($request->get('sucursal_destino')));
                
            }
        }
        

        return redirect('transferencia');
    }

    

    public function show(Transferencia $transferencia,$id)
    {
        $transferencia = Transferencia::findOrFail($id);
        $origen = DB::table('transferencias')
                    ->join('sucursals', 'sucursals.id', '=', 'transferencias.sucursal_origen')
                    ->select("sucursals.nombre")
                    ->where('transferencias.id','=',$id)
                    ->first();
        $destino = DB::table('transferencias')
                    ->join('sucursals', 'sucursals.id', '=', 'transferencias.sucursal_destino')
                    ->select("sucursals.nombre")
                    ->where('transferencias.id','=',$id)
                    ->first();
        $tabla = DB::table('transferencia_detalles')
                    ->join('productos', 'productos.id', '=', 'transferencia_detalles.codigo_producto')
                    ->where('id_transferencia','=',$id)
                    ->get();

        return view('transferencia.show',compact('transferencia','origen','destino','tabla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transferencia  $transferencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Transferencia $transferencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transferencia  $transferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transferencia $transferencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transferencia  $transferencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transferencia $transferencia,$id)
    {
        Transferencia::destroy($id);
        return redirect('transferencia');
    }

    public function llenar()
    {
        $db_handle = new Productos();
        $existe = $db_handle->existeCodigoBarra($_POST["codigoI"],$_POST["sucursal"]);

        if(!empty($_POST["codigoI"]) && !empty($_POST["sucursal"])){

            if($existe == 0){
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'>No existe codigo de producto</h5></span>";
            }else{
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
            }
        }else{
            echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
        }
        
        
    }
    public function validarCantidadProducto()
    {
        $db_handle = new TransferenciaDetalle();
        $cantidad = $db_handle->cantidadActual($_POST["codigoI"],$_POST["sucursal"]);

        if(!empty($_POST["codigoI"]) && !empty($_POST["sucursal"])){

            if($cantidad < $_POST["cantidad"]){
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'>Cantidad ingresada sobrepasa al inventario</h5></span>";
            }else{
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
            }
        }else{
            echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
        }
        
         
    }

    public function imprimir($id){
        $transferencia = Transferencia::findOrFail($id);
        $origen = DB::table('transferencias')
                    ->join('sucursals', 'sucursals.id', '=', 'transferencias.sucursal_origen')
                    ->select("sucursals.nombre")
                    ->where('transferencias.id','=',$id)
                    ->first();
        $destino = DB::table('transferencias')
                    ->join('sucursals', 'sucursals.id', '=', 'transferencias.sucursal_destino')
                    ->select("sucursals.nombre")
                    ->where('transferencias.id','=',$id)
                    ->first();
        $tabla = DB::table('transferencia_detalles')
                    ->join('productos', 'productos.id', '=', 'transferencia_detalles.codigo_producto')
                    ->where('id_transferencia','=',$id)
                    ->get();


        $pdf = \PDF::loadView('transferencia.pdf',compact('transferencia','origen','destino','tabla'));// direccion del view, enviando variable.
    
        return $pdf->setPaper('a4', 'landscape')->stream('Preveedores.pdf');//stream-> solo muestra en el navegador
        //a4, landscape-> enviar en formato horizontal
    }
}
