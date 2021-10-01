<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Cliente;
use App\Sucursal;
use App\Venta;
use App\VentaDetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    
    public function index() 
    {
        $ventas = Venta::all();
     //   $ventasDetalles = VentaDetalle::all();
      //  $VentasSucursales = Venta::ventaXsucursal();
        //dd($VentasSucursales);
       return view('venta.index', compact('ventas'));
    }
    public function create()
    {
        $sucursal = Sucursal::all();
        $clientes = Cliente::all();
        return view('venta.create',compact('sucursal','clientes'));
    }
    public function getProducto(Request $request, $id)
    {
        if($request->ajax()){
            $producto=Productos::producto($id);
            return response()->json( $producto);
        }
    } 
    public function getCliente(Request $request, $id)
    {
        if($request->ajax()){
            $cliente=Cliente::getCliente($id);
            return response()->json($cliente);
        }
    } 
    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->cliente = $request->input('nombre_contacto');
        $venta->nit = $request->input('nit');
        $venta->fecha = $request->input('fecha');
        $venta->tipo_venta = $request->input('tipo_compra');
        $venta->id_sucursal = $request->get('sucursal_origen');
        $venta->comprobante = $request->input('comprobante');
        $venta->total = $request->input('total');
        $venta->recibo = $request->input('recibo');
        $venta->cambio = $request->input('cambio');
        $venta->observaciones = $request->input('observaciones');
        $venta->responsable_venta = $request->input('responsable_venta');
     //   $r_id_cliente=Cliente::getIdCliente($request->input('nit'));
        //dd($r_id_cliente[0]);
       // $venta->id_cliente = $r_id_cliente[0];
        $venta->save();
        $id_venta = DB::table('ventas')
        ->select('id')
        ->where('fecha','=',request('fecha'))// BUSCAR OTRO METODO, DE SACAR ID, POSIBLE INCONSISTENCIA SI EN DOS SUCURSALES GUARDAN UNA VENTA AL MISMO TIEMPO
        ->first();
       // dd($id_venta);
        if($request->input('codigoI') && $request->input('nombre') && $request->input('cantidad') && $request->input('unidad') && $request->input('precio') && $request->input('subTotal')){
            $codigo_barra = request('codigoI');
            $nombre = request('nombre');
            $cantidad = request('cantidad');
            $unidad = request('unidad');
            $precio = request('precio');
            $subTotal = request('subTotal');
            for ($i=0; $i < sizeOf($nombre); $i++) { 
                $venta_detalle = new VentaDetalle();
                $venta_detalle->codigo_barra = $codigo_barra[$i];;
                $venta_detalle->nombre = $nombre[$i];
                $venta_detalle->cantidad = $cantidad[$i];
                $venta_detalle->unidad = $unidad[$i];
                $venta_detalle->precio = $precio[$i];
                $venta_detalle->sub_total = $subTotal[$i];
                $venta_detalle->id_venta = $id_venta->id;
                $venta_detalle->save();
            }
            //$pdf = \PDF::loadView('venta.reciboPdf',compact('venta','codigo_producto','nombre','cantidad','unidad'))
            //->setOptions(['dpi' => 200, 'defaultFont' => 'sans-serif']);// direccion del view, enviando variable.
            return redirect('/venta');//->$pdf->setPaper('a4')->download('ventas.pdf');//stream-> solo muestra en el navegador
        }       
    }

    public function show(Venta $venta)
    {
        return view('venta.view', compact('venta'));
    }
    public function edit(Venta $venta)
    {
        return view('venta.edit', compact('venta'));
    } 
    public function update(Request $request, Venta $venta)
    {
        $venta->nit = $request->input('nit');
        $venta->nombre_empresa = $request->input('nombre_empresa');
        $venta->nombre_contacto = $request->input('nombre_contacto');
        $venta->direccion = $request->input('direccion');
        $venta->telefono = $request->input('telefono');
        $venta->email = $request->input('email');
        $venta->web_site = $request->input('web_site');
        $venta->categoria = $request->input('categoria');
        $venta->save();
        return redirect('/venta');
    }
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect('/venta');
    }
    public function imprimir(){
      //  $ventas = Venta::all();
        $ventasDetalles = VentaDetalle::all();
        $VentasSucursales = Venta::ventaXsucursal();
        $pdf = \PDF::loadView('venta.pdf',compact('VentasSucursales', 'ventasDetalles'));// direccion del view, enviando variable.
    
        return $pdf->setPaper('a4', 'landscape')->stream('ventas.pdf');//stream-> solo muestra en el navegador
        //a4, landscape-> enviar en formato horizontal
    }
    public function imprimirRecibo(){
       
      }
    
    function fetchNit(Request $request, $id)
    {
        if($request->ajax()){
            $cliente=Cliente::getNit($id);
            return response()->json( $cliente);
        }
    }
   

    function fetchName(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('clientes')
        ->where('nombre_contacto', 'LIKE', "{$query}%")
        ->get();
      $output = '<datalist id="datalistOptionsName">';
      foreach($data as $row)
      {
       $output .= '
       <option>'.$row->nombre_contacto.'</option>
       ';
      }
      $output .= '</datalist>';
      echo $output;
     }
    }
    function fetchNitR(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('clientes')
        ->where('nit', 'LIKE', "{$query}%")
        ->get();
      $output = '<datalist id="datalistOptionsNit">';
      foreach($data as $row)
      {
       $output .= '
       <option>'.$row->nit.'</option>
       ';
      }
      $output .= '</datalist>';
      echo $output;
     }
    }
    function fetchCodigoP(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $sucursalID = $request->get('sucursalID');
      $data = DB::table('productos')
        ->where('codigo_barra', 'LIKE', "{$query}%")
        ->where('id_sucursal', '=', $sucursalID)
        ->get();
      $output = '<datalist id="codigo">';
      foreach($data as $row)
      {
       $output .= '
       <option>'.$row->codigo_barra.'</option>
       ';
      }
      $output .= '</datalist>';
      echo $output;
     }
    }
    public function validarCodigoBarra()
    {
        $db_handle = new Productos();
        $existe = $db_handle->existeCodigoBarra($_POST["codigoI"],$_POST["sucursal"]);

        if(!empty($_POST["codigoI"]) && !empty($_POST["sucursal"])){

            if($existe == 0){
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'>No existe codigo de productoT</h5></span>";
            }else{
                echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
            }
        }else{
            echo "<span  class='estado-nulo'><h5 class='estado-nulo'> </h5></span>";
        }
        
        
    }
} 
