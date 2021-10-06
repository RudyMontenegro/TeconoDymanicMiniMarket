<?php

namespace App\Http\Controllers;

use App\Compra;
use App\CompraDetalle;
use App\Proveedor;
use App\Sucursal;
use App\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Sabberworm\CSS\Value\Size;

class CompraController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::paginate(10);
        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedor = Proveedor::all();
        $sucursal = Sucursal::all();
        return view('compra.create',['proveedor'=>$proveedor,'sucursal'=>$sucursal]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $codigo=Productos::nombres2($id);
            return response()->json( $codigo);
        }
    }



    public function store(Request $request) 
    {
        $compra = new Compra();
        
        $compra->comprobante = request('comprobante');
        $compra->responsable_compra = request('responsable_compra');
        $compra->fecha = request('fecha');
        $compra->tipo_compra = $request->get('tipo_compra');
        $compra->total = request('total');
        $compra->recibo = request('recibo');
        $compra->cambio = request('cambio');
        $compra->observaciones = request('observaciones');
        $compra->id_sucursal = $request->get('sucursal_origen');
        $compra->id_proveedor = $request->get('proveedor');

        $compra->save(); 

        $id_compra = DB::table('compras')
                   ->select('id')
                   ->where('fecha','=', request('fecha'))
                   ->first();
        //*dd($id_compra);
        if($request->input('codigoI') && $request->input('nombre') && $request->input('cantidad') && $request->input('unidad') && $request->input('precio') && $request->input('subTotal')){
            $codigo_barra  = request('codigoI');
            $nombre = request('nombre');
            $cantidad = request('cantidad');
            $unidad = request('unidad');
            $precio = request('precio');
            $sub_total = request('subTotal');

            for($i=0; $i < sizeof($nombre); $i++){
                $compra_detalle = new CompraDetalle();
                $compra_detalle-> codigo_barra =  $codigo_barra[$i];
                $compra_detalle-> nombre = $nombre[$i];
                $compra_detalle-> cantidad = $cantidad[$i];
                $compra_detalle-> unidad = $unidad[$i];
                $compra_detalle-> precio = $precio[$i];
                $compra_detalle-> sub_total = $sub_total[$i];
                $compra_detalle-> id_compra = $id_compra->id;

                $id2 = DB::table('productos')
                ->select('id')
                ->where('codigo_barra','=', $codigo_barra[$i])
                ->first();

                
                
                $cantidad_origen = DB::table('productos')
                ->select('cantidad')
                ->where('id','=', intval($id2->id))
                ->first();

               $res = intval($cantidad_origen->cantidad)+$cantidad[$i];

                DB::table('productos')
                ->where('id',  intval($id2->id))
                ->where('id_sucursal', $request->get('sucursal_origen'))
                ->update(['cantidad' => $res]);
                 
                $compra_detalle->save();
                //$compra_detalle->aumentarInventario($codigo_barra[$i],intval($cantidad[$i]),intval($request->get('sucursal_origen')));
            }
        }
        return redirect('compra');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra, $id)
    {
        $compra = Compra::findOrFail($id);

        $comprasDetalles = DB::table('compra_detalles')
        ->where('id_compra','=',$id)
        ->select('*')
        ->get();

        $sucursal = Sucursal::all();

        return view('compra.view', compact('compra','sucursal','comprasDetalles')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra, $id)
    {
        $compra = DB::table('compras')
        ->select('*')
        ->where('id','=',$id)
        ->first();

        $proveedors = DB::table('compras')
        ->join('proveedors','compras.id_proveedor','=','proveedors.id')
        ->select('*')
        ->where('compras.id','=',$id)->first();
        return view('compra.edit',['compra' => $compra,'proveedor' => $proveedors]);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra,$id)
    {
        $compra = Compra::FindOrAll($id);

        $compra->comprobante = $request->input('comprobante');
        $compra->responsable_compra = $request->input('responsable_compra');
        $compra->fecha = $request->input('fecha');
        $compra->tipo_compra = $request->input('tipo_compra');
        $compra->observaciones = $request->input('observaciones');
        $compra->id_sucursal = $request->input('sucursal');
        $compra->id_proveedor = $request->input('proveedor');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra, $id)
    {
        Compra::destroy($id);
        return redirect('compra');
    }
    public function llenado()
    {
        $db_handle = new CompraDetalle();
        $existe = $db_handle->existe($_POST["codigoI"],$_POST["sucursal"]);

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
    
    public function imprimir(){

       $comprasDetalles = CompraDetalle::all();
       $ComprasSucursales = Compra::compraXsucursal();
               
       $pdf = \PDF::loadView('compra.pdf',compact('ComprasSucursales','comprasDetalles'));// direccion del view, enviando variable.

        return $pdf->setPaper('a4', 'landscape')->stream('compras.pdf');//stream-> solo muestra en el navegador
        //a4, landscape-> enviar en formato horizontal
    }

}
