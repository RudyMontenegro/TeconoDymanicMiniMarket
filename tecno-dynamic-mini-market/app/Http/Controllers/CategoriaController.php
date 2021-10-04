<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('producto.createCat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.createCat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categoria = new Categoria();
        $categoria->nombre = request('nombre');
        $categoria->descripcion = request('descripcion');
        $categoria->save();
        return redirect('producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria,$id)
    {
        $categoria = Categoria::find($id);
        return view('producto.editCat',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria,$id)
    {
        $categoria = Categoria::FindOrFail($id);
        $categoria->nombre = request('nombre');
        $categoria->descripcion = request('descripcion');
        $categoria->update();

        return redirect('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria,$id)
    {
        Categoria::destroy($id);
        return redirect('producto');
    }

    public function validar(Categoria $categoria)
    {
        $db_handle = new Categoria();

        if(!empty($_POST["nombre"])) {
            $user_count = $db_handle->numRows($_POST["nombre"]);
            $contador = $db_handle->cuenta($_POST["nombre"]);
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($user_count>0) {
                    echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Nombre de la categoria no disponible</h5></span>";
                }else{
                    echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Categoria disponible</h5></span>";
                }
            }
            
        }
    }

    public function validarEditar(Categoria $categoria)
    {
        $db_handle = new Categoria();

        if(!empty($_POST["nombre"])) {
            $user_count = $db_handle->numRows($_POST["nombre"]);
            $contador = $db_handle->cuenta($_POST["nombre"]);
            $valida = DB::table('categorias')
                        ->select('nombre')
                        ->where('id','=',$_POST["id"])
                        ->first();
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>";
            }else{
                if($valida->nombre == $_POST["nombre"]){
                    echo "<span  class='menor'><h5 class='menor'> </h5></span>";
                }else{
                    if($user_count>0) {
                        echo "<span  class='estado-no-disponible-usuario'><h5 class='estado-no-disponible-usuario'>Nombre de la categoria no disponible</h5></span>";
                    }else{
                        echo "<span class='estado-disponible-usuario'><h5 class='estado-disponible-usuario'>Categoria disponible</h5></span>";
                    }
                }
            }
            
        }
    }
}
