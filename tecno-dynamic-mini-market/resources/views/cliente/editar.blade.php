@extends('layouts.panel')
@section('subtitulo','clientes')
@section('content')
<div class="card shadow">
<div class="box-header ">
                  <h3 class="text-center">EDITAR CLIENTE</h3>
            </div></br>   
  
<form action="{{ url('cliente/'.$cliente->id) }}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    {{ method_field('PATCH') }} 
<div class="col-md-11 mx-auto">

 
<div class = 'row'>

    <div class="col-5">
          <label form="nit">NIT</label>
                            <input class="form-control {{$errors->has('id_numero')?'is-invalid':'' }}" type="text" name="nit" id="nit" placeholder="Ingrese el NIT" value="{{ isset($cliente->nit)?$cliente->nit:old('nit') }}" required>

    </div>  
    <div class="col-5">
          <label form="empresa">Nombre de Empresa</label>
          <input class="form-control" type="text" name="nombre_empresa" id="nombre_empresa"  Placeholder="Ingrese el nombre de la empresa" value="{{ isset($cliente->nombre_empresa)?$cliente->nombre_empresa:old('nombre_empresa') }}" required>

    </div>  
    <div class="col-5"> 
         <label form="contacto">Nombre de Contacto</label>
         <input class="form-control" type="text" name="nombre_contacto" id="nombre_contacto"  Placeholder="Ingrese el nombre del contacto" value="{{ isset($cliente->nombre_contacto)?$cliente->nombre_contacto:old('nombre-contacto') }}" required>
    </div>

    <div class="col-5">
         <label form="direccion">Direccion</label>
         <input class="form-control" type="text" name="direccion" id="direccion" Placeholder="Ingrese la direccion" value="{{ isset($cliente->direccion)?$cliente->direccion:old('direccion') }}" required>

    </div>
    <div class="col-5">
         <label form="telefono">Telefono</label>
         <input class="form-control" type="number" name="telefono" id="telefono"  Placeholder="Ingrese su telefono" value="{{ isset($cliente->telefono)?$cliente->telefono:old('telefono') }}" required>
                      
    </div>
    <div class="col-5">
         <label form="correo">Correo</label>
         <input class="form-control" type="email" name="email" id="email" Placeholder="Ingrese su correo"  value="{{ isset($cliente->email)?$cliente->email:old('email') }}" required>
  
    </div>
       <div class="col-5">
          <label form="web">Sitio Web</label>
          <input class="form-control" type="email" name="web_site" id="web_site" Placeholder="Ingrese el sitio web"  value="{{ isset($cliente->web_site)?$cliente->web_site:old('web_site') }}" required>
                       
         </div>
    </div>
                         </br>
                         </br>
                         <div class="form-group">
                        <input type="submit" class="btn btn-success my-2 my-sm-0" value="Agregar">
                        <a href="{{ url('/cliente')}}" class="btn btn-primary my-2 my-sm-0">Atras</a>
                        
                </div>
            </div>
        </div>
    </div>
</form>
@endsection