@extends('layouts.panel')

@section('subtitulo','PRODUCTOS')
@section('content')
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

 <script>
        function comprobarCodigo() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/producto/validarEditarCodigo",
            data:{
                "_token": "{{ csrf_token() }}",
                "codigo": $("#codigo").val(),
                "id": "{{ $producto->id }}",
            },
            asycn:false,
            type: "POST",
            success:function(data){
                $("#estadoCodigo").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){
                console.log('no da'); 
            }
            });
        }
        function comprobarCodigoBarra() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/producto/validarEditarCodigoBarra",
            data:{
                "_token": "{{ csrf_token() }}",
                "codigoBarra": $("#codigoBarra").val(),
                "id": "{{ $producto->id }}",
            },
            asycn:false,
            type: "POST",
            success:function(data){
                $("#estadoCodigoBarra").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){
                console.log('no da');
            }
            });
        }
        function comprobarNombre() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/producto/validarNombreEdit",
            data:{
                "_token": "{{ csrf_token() }}",
                "nombre": $("#nombre").val(),
                "id": "{{ $producto->id }}",
            },
            asycn:false,
            type: "POST",
            success:function(data){
                $("#estadoProducto").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){
                console.log('no da');
            }
            });
        }
        function validarMarca() {

            if($("#marca").val() == ""){
                $("#estadoMarca").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{  
                if($("#marca").val().length < 3){
                    $("#estadoMarca").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                    if($("#marca").val().length > 50){
                        $("#estadoMarca").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    }else{
                        var re = new RegExp("^[0-9a-zA-Z ]+$");
                        if(!re.test($("#marca").val())){
                            $("#estadoMarca").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                        }else{
                            $("#estadoMarca").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                    
                    }
                    
                }
            
            }
        }
        
        function validarPrecioCosto() {
               
            if($("#precioCosto").val() == ""){
                $("#estadoPrecioCosto").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{     
                var re = new RegExp("^[+-]?([1-9]+\.?[0-9]*|\.[0-9]+)$");
                    if(!re.test($("#precioCosto").val()) ){
                        $("#estadoPrecioCosto").html("<span  class='menor'><h5 class='menor'>Monto ingresado incorrecto</h5></span>");
                    }else{
                         $("#estadoPrecioCosto").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
            }

                    
        }

        function validarPrecioVentaMayor() {
            
            if($("#precioVentaMayor").val() == ""){
                $("#estadoPrecioVentaMayor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{

                var re = new RegExp("^[+-]?([1-9]+\.?[0-9]*|\.[0-9]+)$");
                
                if(!re.test($("#precioVentaMayor").val())){
                    $("#estadoPrecioVentaMayor").html("<span  class='menor'><h5 class='menor'>Monto ingresado incorrecto</h5></span>");
                }else{
                    $("#estadoPrecioVentaMayor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
            }
        }
        function validarPrecioVentaMenor() {
            
            if($("#precioVentaMenor").val() == ""){
                $("#estadoPrecioVentaMenor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                var re = new RegExp("^[+-]?([1-9]+\.?[0-9]*|\.[0-9]+)$");
                
                if(!re.test($("#precioVentaMenor").val())){
                    $("#estadoPrecioVentaMenor").html("<span  class='menor'><h5 class='menor'>Monto ingresado incorrecto</h5></span>");
                }else{
                    $("#estadoPrecioVentaMenor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
            }
        }
        function validarCantidad() {
            var prueba = document.getElementById("cantidad");
            var re = new RegExp("^[0-9]+$");
            if($("#cantidad").val() == ""){
                $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#cantidad").val() <= 0){
                    $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
                }else{
                    if(!re.test($("#cantidad").val()) || $("#cantidad").val() == 'e' ||  $("#cantidad").val() == '-'){
                        $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'>Cantidad ingresada incorrecta</h5></span>");
                    }else{
                        prueba.style.borderColor = '#cad1d7';
                        $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
                }
            }
        }
        function validarUnidad() {
            
            var re = new RegExp("^[a-zA-Z ]+$");
            if($("#unidad").val() == ""){
                $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#unidad").val().length < 3){
                    $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                    if($("#unidad").val().length > 50){
                        $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    }else{
                        if(!re.test($("#unidad").val()) ||  $("#unidad").val() == '-'){
                            $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                        }else{
                            $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                    }
                }
                
            }
        }
        function validarCantidadInicial() {
            var prueba = document.getElementById("cantidad");
            var re = new RegExp("^[0-9]+$");
            if($("#cantidadInicial").val() == ""){
                $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#cantidadInicial").val() <= 0){
                    $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
                }else{
                    if(!re.test($("#cantidadInicial").val()) || $("#cantidadInicial").val() == 'e' ||  $("#cantidadInicial").val() == '-'){
                        $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'>Cantidad ingresada incorrecta</h5></span>");
                    }else{
                        prueba.style.borderColor = '#cad1d7';
                        $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
                }
            }

          
        }

        function validarNotificacion(){
            if($("#notificacion").val() == 1){
                
                $("#estadoNotificacion").html("<span  class='menor'><h5 class='menor'></h5></span>");
                
            }else{
                if($("#fecha").val() == ""){
                    $("#estadoNotificacion").html("<span  class='menor'><h5 class='menor'>Ingrese una fecha de vencimiento</h5></span>");
                }else{
                    $("#estadoNotificacion").html("<span  class='menor'><h5 class='menor'></h5></span>");
                }
            }
        }

        function validarCategoria() {
            
            var cod = document.getElementById("categoria").value;
            //console.log(cod);
            if(cod != "Elige una Categoria"){
                $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'>Seleccione una categoria</h5></span>");
            }
        }

        function validarProveedor() {
            
            var cod = document.getElementById("proveedor").value;
            //console.log(cod);
            if(cod != "Elige un Proveedor"){
                $("#estadoProveedor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                $("#estadoProveedor").html("<span  class='menor'><h5 class='menor'>Seleccione un proveedor</h5></span>");
            }
        }

        
        
    </script>
<div class="card shadow">
    <div class="card-header border-0">
         <h1 class="text-center">EDITAR PRODUCTO</h1>
    </div>
    <form action="{{url('/producto/editar/'.$producto->id)}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        {{method_field('PATCH')}}
    
    <div class="col-md-11 mx-auto "> 

        <div class="row justify-content-center">
            <div class="col-5">
        
                <label for="codigo" class="control-label">{{'Codigo'}}</label>
                <input type="text"  class="form-control  {{$errors->has('codigo')?'is-invalid':'' }}" name="codigo" id="codigo" 
                value="{{ isset($producto->codigo)?$producto->codigo:old('codigo') }}"  onblur="comprobarCodigo()"
                ><span id="estadoCodigo"></span>
                {!!  $errors->first('codigo','<div class="invalid-feedback">:message</div>') !!}
               
        
            </div> 
            <div class="col-5">
                <label for="codigoBarra"class="control-label">{{'Codigo Barra'}}</label>
                <input  type="text" class="form-control  {{$errors->has('codigoBarra')?'is-invalid':'' }}" name="codigoBarra" id="codigoBarra" 
                value="{{ isset($producto->codigo_barra)?$producto->codigo_barra:old('codigoBarra')  }}" onblur="comprobarCodigoBarra()"
                ><span id="estadoCodigoBarra"></span>
            {!!  $errors->first('codigoBarra','<div class="invalid-feedback">:message</div>') !!}
            </div>
           
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="nombre"class="control-label">{{'Nombre'}}</label>
                <input  type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
                value="{{ isset($producto->nombre)?$producto->nombre:old('nombre') }}" onblur="comprobarNombre()"
                ><span id="estadoProducto"></span>
                {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="categoria"class="control-label">{{'Categoria'}}</label>
                <select name="categoria" id="categoria" class="form-control  {{$errors->has('proveedor')?'is-invalid':'' }}" onblur="validarCategoria()">
                    <option selected disabled>Elige una Carrera para este Usuario</option>
                    @foreach ($categoria as $categoria)
                    @if ($categoria->nombre == $categoria_elegida->nombre)
                    <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
                    @else
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endif
                    @endforeach 
                    </select>
                    <span id="estadoCategoria"></span>
                {!!  $errors->first('categoria','<div class="invalid-feedback">:message</div>') !!}
            </div>
                           
            
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="marca"class="control-label">{{'Marca'}}</label>
                <input  type="text" class="form-control  {{$errors->has('marca')?'is-invalid':'' }}" name="marca" id="marca" onkeyup="validarMarca()"
                value="{{ isset($producto->marca)?$producto->marca:old('marca') }}"
                ><span id="estadoMarca"></span>
                {!!  $errors->first('marca','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="precioCosto"class="control-label">{{'Precio Costo'}}</label>
                <input  type="number" step="0.01" class="form-control  {{$errors->has('precioCosto')?'is-invalid':'' }}" name="precioCosto" id="precioCosto" 
                value="{{ isset($producto->precio_costo)?$producto->precio_costo:old('precioCosto') }}" onkeyup="validarPrecioCosto()"
                ><span id="estadoPrecioCosto"></span>
                {!!  $errors->first('precioCosto','<div class="invalid-feedback">:message</div>') !!}
            </div>
               
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="precioVentaMayor"class="control-label">{{'Precio Venta Mayor'}}</label>
                <input  type="number" step="0.01"class="form-control  {{$errors->has('precioVentaMayor')?'is-invalid':'' }}" name="precioVentaMayor" id="precioVentaMayor" 
                value="{{ isset($producto->precio_venta_mayor)?$producto->precio_venta_mayor:old('precioVentaMayor')  }}" onkeyup="validarPrecioVentaMayor()"
                ><span id="estadoPrecioVentaMayor"></span>
                {!!  $errors->first('precioVentaMayor','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="precioVentaMenor"class="control-label">{{'Precio Venta Menor'}}</label>
                <input  type="number" step="0.01" class="form-control  {{$errors->has('precioVentaMenor')?'is-invalid':'' }}" name="precioVentaMenor" id="precioVentaMenor" 
                value="{{ isset($producto->precio_venta_menor)?$producto->precio_venta_menor:old('precioVentaMenor')  }}" onkeyup="validarPrecioVentaMenor()"
                ><span id="estadoPrecioVentaMenor"></span>
                {!!  $errors->first('precioVentaMenor','<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>  
        <div class="row justify-content-center">
            <div class="col-5">
                    <label for="cantidad"class="control-label">{{'Cantidad'}}</label>
                    <input  type="integer" class="form-control  {{$errors->has('cantidad')?'is-invalid':'' }}" name="cantidad" id="cantidad" 
                    value="{{ isset($producto->cantidad)?$producto->cantidad:old('cantidad') }}" onkeyup="validarCantidad()" 
                    ><span id="estadoCantidad"></span>
                    {!!  $errors->first('cantidad','<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-5">
                    <label for="unidad"class="control-label">{{'Unidad'}}</label>
                    <input  type="text" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}" name="unidad" id="unidad" 
                    value="{{ isset($producto->unidad)?$producto->unidad:old('unidad') }}"  onkeyup="validarUnidad()"
                    ><span id="estadoUnidad"></span>
                    {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div> 
            <div class="row justify-content-center">
            <div class="col-5">
                    <label for="fecha"class="control-label">{{'Fecha de Vencimiento'}}</label>
                    <input type="date" class="form-control" name="fecha" id="fecha"  onchange="validarNotificacion()"
                    value="{{ isset($producto->fecha_vencimiento)?$producto->fecha_vencimiento:old('fecha_vencimiento') }}"
                    >
                    <select name="notificacion" id="notificacion" onchange="validarNotificacion()" class="form-control" >
                      
                        @if ($producto->bandera == 1)
                            <option  value="1" selected>Sin notificacion</option>
                            <option  value="2">Notificar 1 semana</option>
                            <option  value="3">Notificar 2 meses</option>
                        @else
                            @if ($producto->bandera == 2)
                            <option  value="1">Sin notificacion</option>
                            <option  value="2" selected>Notificar 1 semana</option>
                            <option  value="3">Notificar 2 meses</option>
                            @else
                                @if ($producto->bandera == 3)
                                <option  value="1">Sin notificacion</option>
                                <option  value="2" >Notificar 1 semana</option>
                                <option  value="3"selected>Notificar 2 meses</option>
                                @endif
                            @endif
                        @endif
                    </select>
                    <span id="estadoNotificacion"></span>
                </div>
            <div class="col-5">
                <label for="foto"class="control-label">{{'Foto'}}</label>
                <input type="file" accept="image/*" class="form-control  {{$errors->has('foto')?'is-invalid':'' }}" name="foto" id="foto" 
                value="{{ isset($personal->password)?$personal->password:old('foto') }}"
                >
                
            </div>
        </div> 
        <br>
        <div class="row justify-content-center">
    
            <div class="col-5">  
                <a href="{{url('producto')}}"class="btn btn-primary">Regresar</a>
            </div>
            <div class="col-5">       
                <input type="submit" class="btn btn-success float-right" value="Guardar">
            </div>
        </div>
    </div>

</form>
<br>

    

</div>

@endsection