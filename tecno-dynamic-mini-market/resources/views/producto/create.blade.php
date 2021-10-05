@extends('layouts.panel')

@section('subtitulo',' ')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
         <h1 class="text-center">REGISTRO DE NUEVO PRODUCTO</h1>
         
    </div>
    <div class="col-md-6 mx-auto " >
            <h2 >
             @include('Mensaje.nota')
         </h2> 
    </div>
     

    <script>
        function comprobarNombre() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/producto/validar",
            data:{
                "_token": "{{ csrf_token() }}",
                "nombre": $("#nombre").val(),
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
        function comprobarCodigo() {
            $("#loaderIcon").show();
            
            jQuery.ajax({
            url: "/producto/validarCodigo",
            data:{
                "_token": "{{ csrf_token() }}",
                "codigo": $("#codigo").val(),
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
            url: "/producto/validarCodigoBarra",
            data:{
                "_token": "{{ csrf_token() }}",
                "codigoBarra": $("#codigoBarra").val(),
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
                    //    var re = new RegExp("^[0-9a-zA-Z ]+$");
                        var regex = /^[a-zA-Z ]+$/;
                        if(!regex.test($("#marca").val())){
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
                var re = new RegExp("^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$");
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

                var re = new RegExp("^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$");
                
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
                var re = new RegExp("^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$");
                
                if(!re.test($("#precioVentaMenor").val())){
                    $("#estadoPrecioVentaMenor").html("<span  class='menor'><h5 class='menor'>Monto ingresado incorrecto</h5></span>");
                }else{
                    $("#estadoPrecioVentaMenor").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
            }
        }
        function validarCantidad() {
            
            if($("#cantidad").val() == ""){
                $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#cantidad").val() <= 0){
                    $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
                }else{
                    $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
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
            var re = new RegExp("^[1-9]{1,7}$");
            
            if($("#cantidadInicial").val() == ""){
                $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#cantidadInicial").val() == "0"){
                    $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
                }else{
                    if($("#cantidadInicial").val() > 9999999){
                        $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'>Cantidad invalida</h5></span>");
                    }else{
                        if(!re.test($("#cantidadInicial").val())){
                            $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'>Cantidad ingresada incorrecta</h5></span>");
                        }else{
                            $("#estadoCantidadInicial").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                    }
                   
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

        function validarSucursal() {
            
            var cod = document.getElementById("sucursal").value;
            //console.log(cod);
            if(cod != "Elige una Sucursal"){
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal</h5></span>");
            }
        }
        
        function existeValor($dato){
            var boolean = false;
            var aux = document.getElementById($dato).value;
            if(aux == ""){
                boolean = true;
            }
            return boolean;
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

        function validarTodo(){
            if(existeValor('codigo')){
                event.preventDefault();
            }else{
                if(existeValor('codigoBarra')){
                    event.preventDefault();
                }else{
                    if(existeValor('nombre')){
                        event.preventDefault();
                    }else{
                        if(existeValor('marca')){
                            event.preventDefault();
                        }else{
                            if(existeValor('precioCosto')){
                                event.preventDefault();
                            }else{
                                if(existeValor('precioVentaMayor')){
                                    event.preventDefault();
                                }else{
                                    if(existeValor('precioVentaMenor')){
                                        event.preventDefault();
                                    }else{
                                        if(existeValor('cantidad')){
                                            event.preventDefault();
                                        }else{
                                            if(existeValor('unidad')){
                                                event.preventDefault();
                                            }else{
                                                if(existeValor('cantidadInicial')){
                                                    event.preventDefault();
                                                }else{
                                                    document.getElementById("enviar").submit();
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
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

<form action="{{url('/producto/registrarProducto')}}" class="form" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
   

   <div class="col-md-11 mx-auto "> 

<div class=" row justify-content-center">
    <div class="col-5">

        <label for="codigo" class="control-label">{{'Codigo'}}</label>
        <input type="text" class="form-control  {{$errors->has('codigo')?'is-invalid':'' }}" name="codigo" id="codigo" 
        value="{{ isset($personal->nombre)?$personal->nombre:old('codigo') }}" onblur="comprobarCodigo()"
        ><span id="estadoCodigo"></span>
        {!!  $errors->first('codigo','<div class="invalid-feedback">:message</div>') !!}
       

    </div> 
    <div class="col-5" >
        <label for="codigoBarra"class="control-label">{{'Codigo Barra'}}</label>
        <input type="text" class="form-control  {{$errors->has('codigoBarra')?'is-invalid':'' }}" name="codigoBarra" id="codigoBarra"  
        value="{{ isset($personal->email)?$personal->email:old('codigoBarra')  }}" onblur="comprobarCodigoBarra()"
        ><span id="estadoCodigoBarra"></span>
    {!!  $errors->first('codigoBarra','<div class="invalid-feedback">:message</div>') !!}
    </div>
   
</div>
<div class=" row justify-content-center">
    <div class="col-5" >
        <label for="nombre"class="control-label">{{'Nombre'}}</label>
        <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
        value="{{ isset($personal->apellido)?$personal->apellido:old('nombre') }}" onblur="comprobarNombre()"
        ><span id="estadoProducto"></span>
        {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5" >
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria" class="form-control {{$errors->has('categoria')?'is-invalid':'' }}"  onblur="validarCategoria()">
        <option selected disabled>Elige una Categoria</option>
        @foreach ($categoria as $categoria)
            <option {{ old('categoria') == $categoria->id ? "selected" : "" }} value="{{$categoria->id}}">{{$categoria->nombre}}</option>
        @endforeach
        </select><span id="estadoCategoria"></span>
        {!!  $errors->first('categoria','<div class="invalid-feedback">:message</div>') !!}
    </div>
                   
    
</div>
<div class=" row justify-content-center">
    <div class="col-5" >
        <label for="marca"class="control-label">{{'Marca'}}</label>
        <input type="text" class="form-control  {{$errors->has('marca')?'is-invalid':'' }}" name="marca" id="marca" 
        value="{{ isset($personal->codigoSis)?$personal->codigoSis:old('marca') }}" onkeyup="validarMarca()"
        ><span id="estadoMarca"></span>
        {!!  $errors->first('marca','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5" >
        <label for="precioCosto"class="control-label">{{'Precio Costo'}}</label>
        <input type="number" step="0.01" class="form-control  {{$errors->has('precioCosto')?'is-invalid':'' }}" name="precioCosto" id="precioCosto" 
        value="{{ isset($personal->codigoSis)?$personal->codigoSis:old('precioCosto') }}" onkeyup="validarPrecioCosto()"
        ><span id="estadoPrecioCosto"></span>
        {!!  $errors->first('precioCosto','<div class="invalid-feedback">:message</div>') !!}
    </div>
       
</div>
<div class=" row justify-content-center">
    <div class="col-5" >
        <label for="precioVentaMayor"class="control-label">{{'Precio Venta Mayor'}}</label>
        <input type="number" step="0.01"class="form-control  {{$errors->has('precioVentaMayor')?'is-invalid':'' }}" name="precioVentaMayor" id="precioVentaMayor" 
        value="{{ isset($personal->telefono)?$personal->telefono:old('precioVentaMayor')  }}" onkeyup="validarPrecioVentaMayor()"
        ><span id="estadoPrecioVentaMayor"></span>
        {!!  $errors->first('precioVentaMayor','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5" >
        <label for="precioVentaMenor"class="control-label">{{'Precio Venta Menor'}}</label>
        <input type="number" step="0.01" class="form-control  {{$errors->has('precioVentaMenor')?'is-invalid':'' }}" name="precioVentaMenor" id="precioVentaMenor" 
        value="{{ isset($personal->telefono)?$personal->telefono:old('precioVentaMenor')  }}" onkeyup="validarPrecioVentaMenor()"
        ><span id="estadoPrecioVentaMenor"></span>
        {!!  $errors->first('precioVentaMenor','<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class=" row justify-content-center">
    <div class="col-5" >
            <label for="cantidad"class="control-label">{{'Cantidad'}}</label>
            <input type="number" class="form-control  {{$errors->has('cantidad')?'is-invalid':'' }}" name="cantidad" id="cantidad" 
            value="{{ isset($personal->password)?$personal->password:old('cantidad') }}" onkeyup="validarCantidad()"
            ><span id="estadoCantidad"></span>
            {!!  $errors->first('cantidad','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5" >
            <label for="unidad"class="control-label">{{'Unidad'}}</label>
            <input type="text" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}" name="unidad" id="unidad" 
            value="{{ isset($personal->password)?$personal->password:old('unidad') }}" onkeyup="validarUnidad()"
            ><span id="estadoUnidad"></span>
            {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
        </div>
</div> 
<div class=" row justify-content-center">
    <div class="col-5" >
            <label for="fecha_vencimiento"class="control-label">{{'Fecha de Vencimiento'}}</label>
            <input type="date" class="form-control  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" onchange="validarNotificacion()" 
            value="{{ isset($personal->password)?$personal->password:old('unidad') }}"
            >
            <select name="notificacion" id="notificacion" onchange="validarNotificacion()" class="form-control" >
                <option  value="1">Sin notificacion</option>
                <option  value="2">Notificar 1 semana</option>
                <option  value="3">Notificar 2 meses</option>
            </select>
            <span id="estadoNotificacion"></span>
        </div>
        <div class="col-5" >
            <label for="foto"class="control-label">{{'Foto'}}</label>
            <input type="file" accept="image/*" class="form-control  {{$errors->has('foto')?'is-invalid':'' }}" name="foto" id="foto" 
            value="{{ isset($personal->password)?$personal->password:old('foto') }}"
            >
            {!!  $errors->first('foto','<div class="invalid-feedback">:message</div>') !!}
        </div>
</div>  

<br>
<div class=" row justify-content-center">
    
    <div class="col-5" >  
        <a href="{{url('producto')}}"class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-5">       
        <button id="enviar" class="btn btn-success float-right" onclick="validarTodo()" >Guardar</button>
    </div>
</div>
</div>
</form>
<br>

</div>

@endsection