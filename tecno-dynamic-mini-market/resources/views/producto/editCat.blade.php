@extends('layouts.panel')

@section('subtitulo','sucursal')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="card shadow">
    <div class="card-header border-0">
         <h1 class="text-center">EDITAR CATEGORIA</h1>
         
    </div>
    <div class="col-md-6 mx-auto " >
            <h2 >
             @include('Mensaje.nota')
         </h2> 
    </div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        function comprobarCategoria() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/categoria/validarEditar",
            data:{
                "_token": "{{ csrf_token() }}",
                "nombre": $("#nombre").val(),
                "id": "{{$categoria->id}}",
            },
            asycn:false,
            type: "POST",
            success:function(data){
                $("#estadoCategoria").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){
                console.log('no da');
            }
            });
        }

        function validarNombre() {

            if($("#nombre").val().length < 3){
                $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
            }else{
                if($("#nombre").val().length > 50){
                    $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                    var re = new RegExp("^[0-9a-zA-Z ]+$");
                    if(!re.test($("#nombre").val())){
                        $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z] y [0-9]</h5></span>");
                    }else{
                        $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
                }
                
            }
        }

        function validardescripcion() {

            if($("#descripcion").val().length < 3){
                $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
            }else{
                if($("#nombre").val().length > 50){
                    $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                     var re = new RegExp("^[0-9a-zA-Z ]+$");
                    if(!re.test($("#descripcion").val())){
                        $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                    }else{
                         $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
                   
                }
                
            }
        }
        </script>
        <style>
            .estado-no-disponible-usuario {
                color:#D60202;
            }
            .estado-disponible-usuario {
                color:#2FC332;
            }
            .menor{
                color:#D60202;
            }
        </style>

        
    <form action="{{url('/producto/categoria/editar/'.$categoria->id)}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        {{method_field('PATCH')}}
   
 
    
    <div class=" row justify-content-center">   
    <div class="col-6">
        <label for="nombre"class="control-label">{{'Nombre'}}</label>
        <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
        value="{{ isset($categoria->nombre)?$categoria->nombre:old('nombre')  }}" onBlur="comprobarCategoria()" onkeyup="validarNombre()"
        ><span id="estadoCategoria"></span>
    {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

    <div class=" row justify-content-center">
    <div class="col-6">

        <label for="descripcion" class="control-label">{{'Descripcion'}}</label>
        <input type="text" class="form-control  {{$errors->has('descripcion')?'is-invalid':'' }}" name="descripcion" id="descripcion" 
        value="{{ isset($categoria->descripcion)?$categoria->descripcion:old('descripcion') }}" onkeyup="validardescripcion()"
        ><span id="estadoDescripcion"></span>
        {!!  $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}
       

    </div> 
</div>  

<br>
<br>
<div class=" row justify-content-center">  
            <div class="col-5">  
                <a href="{{url('producto')}}"class="btn btn-primary">Regresar</a>
            </div>
            <div class="col-5">       
                <input type="submit" id="submitBtn" class="btn btn-success float-right"  value="Guardar">
            </div>
        </div>
<br>

</form>
 </div>  


</div>


@endsection