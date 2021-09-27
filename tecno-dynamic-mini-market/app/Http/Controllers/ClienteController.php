<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \PDF;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(10); 
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imprimir(){
        $clientes = Cliente::all();
        $pdf = \PDF::loadView('cliente.pdf',compact('clientes'));
    
        return $pdf->setPaper('a4', 'landscape')->stream('productoshorizontal.pdf');
        
    }
    public function store(Request $request)
    {
        $campos=[
            'nit' => 'required|unique:clientes,nit|max:50|min:3',
            'nombre_empresa' => 'required|unique:clientes,nombre_empresa|max:50|min:3',
            'nombre_contacto' => 'required|unique:clientes,nombre_contacto|max:50|min:3',
            'direccion' => 'required',
            'telefono' => 'required|unique:clientes,telefono',
            'email' => 'required ',
            
        
        ]; 

        $Mensaje = [ 
            
            "required"=>'El campo es requerido',
            "regex"=>'Solo se admiten letras',
            "min"=>'Solo se acepta 3 caracteres como minimo',
            "max"=>'Solo se acepta 50 caracteres como maximo',
            "numeric"=>'Solo se acepta números' ,
            "telefono.unique" => 'El numero de telefono ya esta registrado',
            "nombre_contacto" => 'El nombre del contacto ya esta registrado', 
        ];

        $this->validate($request,$campos,$Mensaje);

            $cliente = new Cliente();

            $cliente->nit = request('nit');
            $cliente->nombre_empresa = request('nombre_empresa');
            $cliente->nombre_contacto = request('nombre_contacto');
            $cliente->direccion = request('direccion');
            $cliente->telefono = request('telefono');
            $cliente->email = request('email');
            $cliente->web_site = request('web_site');
            
            $cliente->save();
            return redirect('cliente');

    }

    /*


        $cliente = new Cliente();
        $cliente->nit = $request->input('nit');
        $cliente->nombre_empresa = $request->input('nombre_empresa');
        $cliente->nombre_contacto = $request->input('nombre_contacto');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->web_site = $request->input('web_site');
        $cliente->save();
        return redirect('cliente');
    }
    */
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $cliente = DB::table('clientes')
            ->select('*')
            ->where('id','=',$id)
            ->first();

        return view('cliente.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente, $id)
    {
        $cliente = Cliente::FindOrAll($id);

        $cliente->nit = $request->input('nit');
        $cliente->nombre_empresa = $request->input('nombre_empresa');
        $cliente->nombre_contacto = $request->input('nombre_contacto');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->web_site = $request->input('web_site');

        $cliente->update();
        return redirect('cliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente, $id)
    {
        Cliente::destroy($id);
        return redirect('cliente');
    }
    public function validar(Cliente $cliente)
    {
        $db_handle = new Cliente();

        if(!empty($_POST["nit"])) {
            $user_count = $db_handle->numRows($_POST["nit"]);
            $contador = $db_handle->cuenta($_POST["nit"]);
            if($contador < 3){
                echo "<span  class='menor'><h5 class='menor'>Ingrese de 1 a 10 caracteres</h5></span>";
            }else{
                if($user_count>0) {
                    echo "<span  class='estado-no-disponible-nit'><h5 class='estado-no-disponible-nit'>Numero de NIT no disponible</h5></span>";
                }else{
                    echo "<span class='estado-disponible-nit'><h5 class='estado-disponible-nit'>Numero de NIT disponible</h5></span>";
                }
            }
            
        } 
    }
}
