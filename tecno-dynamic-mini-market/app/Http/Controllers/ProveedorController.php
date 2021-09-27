<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $proveedores = Proveedor::all();
        return view('proveedor.index', compact('proveedores'));
    }
    public function imprimir(){
        $proveedores = Proveedor::all();
        $pdf = \PDF::loadView('proveedor.pdf',compact('proveedores'));// direccion del view, enviando variable.
    
        return $pdf->setPaper('a4', 'landscape')->stream('Preveedores.pdf');//stream-> solo muestra en el navegador
        //a4, landscape-> enviar en formato horizontal
    }
   
    public function create()
    {
        return view('proveedor.crear');
    }
   
    public function store(Request $request)
    {
       // dd($request->all());
      
       // $this->validate($request);

       $nitBD = DB::table('proveedors')
                ->select('nit')
                ->where('nit','=',request('nit'))
                ->exists();
        
        $nomBD = DB::table('proveedors')
                ->select('nombre_empresa')
                ->where('nombre_empresa','=',request('nombre_empresa'))
                ->exists();

        if($nitBD == false && $nomBD==false){
            
       
        $proveedor = new Proveedor();
        $proveedor->nit = $request->input('nit');
        $proveedor->nombre_empresa = $request->input('nombre_empresa');
        $proveedor->nombre_contacto = $request->input('nombre_contacto');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->web_site = $request->input('web_site');
        $proveedor->categoria = $request->input('categoria');
        $proveedor->save();
        return redirect('/proveedor')->with('Estado','El proveedor registrado correctamente'); 
        return view('proveedor.index', compact('proveedores'));
        }

        else{
        return redirect('/proveedor')->with('Estado','El proveedor ya esta registrado'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedor.view', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedor.edit', compact('proveedor'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->nit = $request->input('nit');
        $proveedor->nombre_empresa = $request->input('nombre_empresa');
        $proveedor->nombre_contacto = $request->input('nombre_contacto');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->web_site = $request->input('web_site');
        $proveedor->categoria = $request->input('categoria');
        $proveedor->save();
        return redirect('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect('/proveedor');
    }
}
