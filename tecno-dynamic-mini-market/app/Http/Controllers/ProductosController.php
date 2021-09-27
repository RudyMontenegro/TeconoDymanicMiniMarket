<?php

namespace App\Http\Controllers;
 
use App\Categoria;
use App\Productos;
use App\Proveedor;
use App\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal = Sucursal::all();
        
        $categoria = Categoria::paginate(3,['*'],'categoria');

        $sucursales = Sucursal::all();

        
        return view('producto.index',['categoria'=>$categoria])->with(compact('sucursal','sucursales'));
    }



    public function prueba(){
        return view('producto.prueba');
    }

    public function filtro(Request $request,$id){
        if($request->ajax()){
            $codigo=Productos::busqueda($id);
            return response()->json( $codigo);
        }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $proveedor = Proveedor::all();
        $categoria = Categoria::all();
        $sucursales = Sucursal::all();

           $sucursal_elegida = DB::table('sucursals')
                                ->select('*')
                                ->where('id','=',$id)
                                ->first(); 
        
        return view('producto.create',['proveedor'=>$proveedor,'categoria'=>$categoria,'sucursales'=>$sucursales,'sucursal_elegida'=>$sucursal_elegida]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $producto = new Productos();

            $producto->codigo = request('codigo');
            $producto->codigo_barra = request('codigoBarra');
            $producto->nombre = request('nombre');
            $producto->marca = request('marca');
            $producto->precio_costo = request('precioCosto');
            $producto->precio_venta_mayor = request('precioVentaMayor');
            $producto->precio_venta_menor = request('precioVentaMenor');
            $producto->cantidad = $request->get('cantidad');
            $producto->unidad = $request->get('unidad');
            $producto->cantidad_inicial = $request->get('cantidadInicial');
            $producto->id_proveedor = $request->get('proveedor');
            $producto->id_categoria = $request->get('categoria');
            $producto->id_sucursal = request('sucursal');

            if($request->hasfile('foto')){
        
                $file =$request->foto;
                
                $producto['ruta_foto']=$request->file('foto')->store('fotos','public');
                
                //$file->move(public_path().'/firmas',$file->getClientOriginalName());
                $producto->foto=$file->getClientOriginalName();
            }

            $producto->save();

            return redirect('producto');
       

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos, $id)
    {
        $producto = DB::table('productos')
        ->select('*')
        ->where('id','=',$id)->first();

        $categorias = DB::table('productos')
                        ->join('categorias','categorias.id','productos.id_categoria')
                        ->select('productos.*','categorias.nombre as categoriaName')
                        ->where('productos.id','=',$id)
                        ->first();

        $proveedors = DB::table('productos')
        ->join('proveedors','productos.id_proveedor','=','proveedors.id')
        ->select('*')
        ->where('productos.id','=',$id)->first();

        return view('producto.view',['producto' => $producto,'proveedors' => $proveedors,'categorias' => $categorias]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $productos,$id)
    {
        $producto = DB::table('productos')
        ->select('*')
        ->where('id','=',$id)->first();

        $proveedors = DB::table('productos')
        ->join('proveedors','productos.id_proveedor','=','proveedors.id')
        ->select('*')
        ->where('productos.id','=',$id)->first();

        $proveedor = Proveedor::all();
        $categoria = Categoria::all();
        $categoria_elegida = DB::table('productos')
        ->join('categorias','categorias.id','=','productos.id_categoria')
        ->select('*')
        ->where('productos.id','=',$id)->first();

        $sucursales = Sucursal::all();
        $sucursal_elegida = DB::table('productos')
        ->join('sucursals','sucursals.id','=','productos.id_sucursal')
        ->select('*')
        ->where('productos.id','=',$id)->first();

        return view('producto.edit',compact('producto','proveedors','proveedor','categoria','categoria_elegida','sucursales','sucursal_elegida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $productos, $id)
    {
        $producto = Productos::FindOrFail($id);

        $producto->codigo = request('codigo');
        $producto->codigo_barra = request('codigoBarra');
        $producto->nombre = request('nombre');
        $producto->categoria = request('categoria');
        $producto->marca = request('marca');
        $producto->precio_costo = request('precioCosto');
        $producto->precio_venta_mayor = request('precioVentaMayor');
        $producto->precio_venta_menor = request('precioVentaMenor');
        $producto->cantidad = $request->get('cantidad');
        $producto->unidad = $request->get('unidad');
        $producto->cantidad_inicial = $request->get('cantidadInicial');
        $producto->id_proveedor = $request->get('proveedor');
        
        if($request->hasfile('foto')){

            //Storage::disk('public')->delete('/firmas'.$auxiliar->firma);
                 
                $file =$request->foto;
                Storage::delete('public/'.$producto->foto);
                $producto['ruta_foto']=$request->file('foto')->store('fotos','public');
               
        
                $producto->foto=$file->getClientOriginalName();

            //$file->move(public_path().'/firmas',$file->getClientOriginalName());
            //$auxiliar->firma=$file->getClientOriginalName();
        }

        $producto->update();

        return redirect('producto');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos,$id)
    {
        $producto = Productos::FindOrFail($id);
        Storage::delete('public/'.$producto->ruta_foto);
        Productos::destroy($id);
        return redirect('producto');
    }

    public function validar(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["nombre"])) {
            $user_count = $db_handle->numRows($_POST["nombre"],$_POST["sucursal"]);
            $contador = $db_handle->cuenta($_POST["nombre"]);
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($user_count>0) {
                    echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Nombre de producto no disponible</h5></span>";
                }else{
                    echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Nombre disponible</h5></span>";
                }
            }
            
        } 
    }

    public function validarCodigo(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["codigo"])) {
            $user_count = $db_handle->numRows2($_POST["codigo"],$_POST["sucursal"]);
            $contador = $db_handle->cuenta($_POST["codigo"]);
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($user_count>0) {
                    echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Codigo de producto no disponible</h5></span>";
                }else{
                    echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Codigo disponible</h5></span>";
                }
            }
            
        }
    }

    public function validarCodigoBarra(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["codigoBarra"])) {
            $user_count = $db_handle->numRows3($_POST["codigoBarra"],$_POST["sucursal"]);
            $contador = $db_handle->cuenta($_POST["codigoBarra"]);
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($user_count>0) {
                    echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Codigo Barra de producto no disponible</h5></span>";
                }else{
                    echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Codigo Barra disponible</h5></span>";
                }
            }
            
        }
    }

    public function validarCodigoEdit(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["codigo"])) {
            $user_count = $db_handle->existe2($_POST["codigo"],$_POST["sucursal"],$_POST["id"]);
            $contador = $db_handle->cuenta($_POST["codigo"]);

            $valida = DB::table('productos')
                        ->select('codigo')
                        ->where('id','=',$_POST["id"])
                        ->first();
                        
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($valida->codigo == $_POST["codigo"]){
                    echo "<span  class='menor'><h5 class='menor'> </h5></span>";
                }else{
                    if($user_count) {
                        echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Codigo de producto no disponible</h5></span>";
                    }else{
                        echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Codigo disponible</h5></span>";
                    }
                }
                
            }
            
        }
    }
    public function validarCodigoBarraEdit(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["codigoBarra"])) {
            $user_count = $db_handle->existe3($_POST["codigoBarra"],$_POST["sucursal"],$_POST["id"]);
            $contador = $db_handle->cuenta($_POST["codigoBarra"]);

            $valida = DB::table('productos')
                        ->select('codigo_barra')
                        ->where('id','=',$_POST["id"])
                        ->first();
                        
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($valida->codigo_barra == $_POST["codigoBarra"]){
                    echo "<span  class='menor'><h5 class='menor'> </h5></span>";
                }else{
                    if($user_count) {
                        echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Codigo de producto no disponible</h5></span>";
                    }else{
                        echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Codigo disponible</h5></span>";
                    }
                }
                
            }
            
        }
    }

    public function validarNombreEdit(Sucursal $sucursal)
    {
        $db_handle = new Productos();

        if(!empty($_POST["nombre"])) {
            $user_count = $db_handle->existe($_POST["nombre"],$_POST["sucursal"],$_POST["id"]);
            $contador = $db_handle->cuenta($_POST["nombre"]);

            $valida = DB::table('productos')
                        ->select('nombre')
                        ->where('id','=',$_POST["id"])
                        ->first();
                        
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($valida->nombre == $_POST["nombre"]){
                    echo "<span  class='menor'><h5 class='menor'> </h5></span>";
                }else{
                    if($user_count) {
                        echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Codigo de producto no disponible</h5></span>";
                    }else{
                        echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Codigo disponible</h5></span>";
                    }
                }
                
            }
            
        }
    }
} 
