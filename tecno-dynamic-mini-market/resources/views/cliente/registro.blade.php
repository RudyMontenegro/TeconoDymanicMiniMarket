@extends('layouts.panel')
@section('subtitulo','clientes')
@section('content')

<head>
      <title>Ajax Autocomplete Textbox in Laravel using JQuery</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
  </head>

<div class="card shadow" style="background-color:#4F9BF6; color: white; font color: yellow !important">
      <div class="card-header border-0">
            <div class="row align-items-center">
                  <div align ="center">
                      <h3>INFORMACION PERSONAL</h3>
                   </div>
             </div>
          </div> 
      </br>

      <script>
            function comprobarNit() {
                $("#loaderIcon").show();
                
                jQuery.ajax({
                url: "/cliente/validar",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "nit": $("#nit").val(),
                },
                asycn:false,
                type: "POST",
                success:function(data){
                    $("#estadoNit").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){
                    console.log('no da');
                }
                });
            }

            function comprobarNombre(){
                
                if($("#nombre_empresa").val() == ""){
                $("#estadoNombreEmpresa").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }else{
                    var re = new RegExp("^[a-zA-Z ]+$");
                if(!re.test($("#nombre_empresa").val())){
                    $("#estadoNombreEmpresa").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                }else{
                    $("#estadoNombreEmpresa").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
              }
            }

            function comprobarContacto(){

                if($("#nombre_contacto").val() == ""){
                    $("#estadoNombreContacto").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }else{
                    var re = new RegExp("^[a-zA-Z ]+$");
                if(!re.test($("#nombre_contacto").val())){
                    $("#estadoNombreContacto").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                }else{
                    $("#estadoNombreContacto").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
               }                
            }
        </script>
        <style>
            .estado-no-disponible-nit {
                color:#D60202;
            }
            .estado-disponible-nit {
                color:#2FC332;
            }
            .menor{
                color:#D60202;
            }
        </style>

<form action="{{ url('registrarCliente')}}" method="post">
    {{csrf_field()}} 
      <div class="col-md-11 mx-auto">

  
             <div class = 'row'>

                  <div class="col-6">
                       <label form="nit">NIT</label>
                       <input class="form-control {{$errors->has('nit')?'is-invalid':'' }}" type="text" name="nit" id="nit" 
                              placeholder="Ingrese el NIT" value="{{ old('nit') }}" onblur="comprobarNit()">
                              <span id="estadoNit"></span>
                         {!!  $errors->first('nit','<div class="invalid-feedback">:message</div>') !!}
                   </div>  

                  <div class="col-6">
                        <label form="empresa" class="control-label">Nombre de Empresa</label>
                        <input class="form-control {{$errors->has('nombre_empresa')?'is-invalid':'' }}" type="text" name="nombre_empresa" id="nombre_empresa"  
                                Placeholder="Ingrese el nombre de la empresa" value="{{ old('empresa') }}" onkeyup="comprobarNombre()">
                                <span id="estadoNombreEmpresa"></span>

                          {!!  $errors->first('nombre_empresa','<div class="invalid-feedback">:message</div>') !!}
                   </div>  

                  <div class="col-6"> 
                         <label form="contacto">Nombre de Contacto</label>
                         <input class="form-control {{$errors->has('nombre_contacto')?'is-invalid':'' }}" type="text" name="nombre_contacto" id="nombre_contacto"  
                               Placeholder="Ingrese el nombre del contacto" value="{{ old('contacto') }}" onkeyup="comprobarContacto()">
                               <span id="estadoNombreContacto"></span>

                           {!!  $errors->first('nombre_contacto','<div class="invalid-feedback">:message</div>') !!}
                   </div>

                  <div class="col-6">
                         <label form="direccion">Direccion</label>
                         <input class="form-control {{$errors->has('direccion')?'is-invalid':'' }}" type="text" name="direccion" id="direccion" 
                                 Placeholder="Ingrese la direccion" value="{{ old('direccion') }}">

                            {!!  $errors->first('direccion','<div class="invalid-feedback">:message</div>') !!}
                   </div>

                  <div class="col-6">
                          <label form="telefono">Telefono</label>
                          <input class="form-control {{$errors->has('telefono')?'is-invalid':'' }}" type="number" name="telefono" id="telefono"  
                                Placeholder="Ingrese su telefono" value="{{ old('telefono') }}">

                            {!!  $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}          
                   </div>

                  <div class="col-6"> 
                         <label form="correo">Correo</label>
                         <input class="form-control {{$errors->has('email')?'is-invalid':'' }}" type="email" name="email" id="email" 
                               Placeholder="Ingrese su correo"  value="{{ old('correo') }}">

                   {!!  $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
                   </div>

                  <div class="col-6">
                          <label form="web">Sitio Web</label>
                          <input class="form-control {{$errors->has('web_site')?'is-invalid':'' }}" type="email" name="web_site" id="web_site" 
                                 Placeholder="Ingrese el sitio web"  value="{{ old('web') }}">

                    {!!  $errors->first('web_site','<div class="invalid-feedback">:message</div>') !!}            
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
