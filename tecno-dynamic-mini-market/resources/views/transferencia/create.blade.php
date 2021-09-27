@extends('layouts.panel')

@section('subtitulo','transferencia') 
@section('content')

<div class="card shadow" style="background-color:#ffffff; color: rgb(0, 0, 0); font color: yellow !important">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva Transferencia</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('transferencia') }}" class="btn btn-sm btn-danger">Canselar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        
        function validaComprobante() {

            if($("#comprobante").val() == ""){
                $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#comprobante").val().length < 3){
                    $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                    if($("#comprobante").val().length > 50){
                        $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    }else{
                        var re = new RegExp("^[0-9a-zA-Z ]+$");
                        if(!re.test($("#comprobante").val())){
                            $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z] y [0-9]</h5></span>");
                        }else{
                            $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                    }
                    
                }
            }
        }
        
        function validarResponsable() {

            if($("#responsable").val() == ""){
                $("#estadoTransferencia").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                if($("#responsable").val().length < 3){
                    $("#estadoTransferencia").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                }else{
                    if($("#responsable").val().length > 50){
                        $("#estadoTransferencia").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    }else{
                         var re = new RegExp("^[a-zA-Z ]+$");
                        if(!re.test($("#responsable").val())){
                            $("#estadoTransferencia").html("<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                        }else{
                             $("#estadoTransferencia").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                       
                    }
                    
                }
            }
        }
 
        function validarFecha(){
            const date = new Date(),
          ten = (i)=> ((i < 10 ? '0' : '') + i ),
                YYYY = date.getFullYear(),
                MTH = ten(date.getMonth() + 1),
                DAY = ten(date.getDate()),
                HH = ten(date.getHours()),
                MM = ten(date.getMinutes()),
                SS = ten(date.getSeconds())
                // MS = ten(date.getMilliseconds())

            document.getElementById("fecha").value=`${YYYY}-${MTH}-${DAY}T${HH}:${MM}`;
        }
        setInterval(validarFecha,30000);

        function validarSucursal() {
            
            var cod = document.getElementById("sucursal_origen").value;
            //console.log(cod);
            if(cod != "Elige una Sucursal de Origen"){
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal</h5></span>");
            }
        }

        function validarSucursalDestino() {
            
            var cod = document.getElementById("sucursal_destino").value;
            console.log(cod);
            if(cod != "Elige una Sucursal de Destino"){
                $("#estadoDestino").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            }else{
                $("#estadoDestino").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal</h5></span>");
            }
        }
        </script>
        <style>
            .menor {
                color:#D60202;
            }
            .estado-nulo{
                color:#D60202;
            }
        </style>
        
        <form action="{{ url('transferencia/registrarTransferencia') }}" method="post">

        {{ csrf_field()}}

            <div class="col-md-12 mx-auto ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="comprobante">Comprobante</label>
                            <input type="text" name="comprobante" id="comprobante" class="form-control" value="{{ old('comprobante')}}"
                            onkeyup="validaComprobante()"><span id="estadoComprobante"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="responsable">Responsable Transferencia</label>
                            <input type="text" name="responsable" id="responsable" class="form-control" ~
                            onkeyup="validarResponsable()"   ><span id="estadoTransferencia"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nanombre_contactome">Fecha</label>
                            <input class="form-control text-dark" type="datetime-local" name="fecha" value=""
                                id="fecha" onblur="validarFecha()">
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sucursal_origen">Sucursal Origen</label>
                        <select name="sucursal_origen" id="sucursal_origen" onblur="validarSucursal()" onchange="validarSucursal()"
                            class="form-control  {{$errors->has('sucursal_origen')?'is-invalid':'' }}">
                            <option selected disabled>Elige una Sucursal de Origen</option>
                            @foreach ($sucursal as $origen)
                            <option {{ old('origen') == $origen->id ? "selected" : "" }} value="{{$origen->id}}">
                                {{$origen->nombre}}</option>
                            @endforeach
                        </select><span id="estadoSucursal"></span>
                        {!! $errors->first('sucursal_origen','<div class="invalid-feedback">:message</div>') !!}

                    </div>
                    <div class="col-6">
                        <label for="sucursal_destino">Sucursal Destino</label>
                        <select name="sucursal_destino" id="sucursal_destino"  onchange="validarSucursalDestino()"
                            class="form-control  {{$errors->has('sucursal_destino')?'is-invalid':'' }}">
                            <option selected disabled>Elige una Sucursal de Destino</option>

                        </select><span id="estadoDestino"></span>
                        {!! $errors->first('sucursal_origen','<div class="invalid-feedback">:message</div>') !!}

                    </div>
                </div>
                <br>
            </div>

            <script>
            $("#sucursal_origen").change(event => {
                $.get(`envio/${event.target.value}`, function(res, sta) {
                    $("#sucursal_destino").empty();
                    $("#sucursal_destino").append(`<option> Elige una Sucursal de Destino </option>`);
                    $("#codigoI").val('');
                    $("#estadoCodigo").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    res.forEach(element => {
                        $("#sucursal_destino").append(
                            `<option value=${element.id}> ${element.nombre} </option>`);
                    });
                    
                });
                validarSucursalDestino();
            });
            </script>
            <div class="col-md-12 mx-auto ">
                @include('transferencia.tabla')

                <br>
                <br>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
    <script>
    var res = 0;
    function calcular() {
        try {
            var a = $("input[id=cantidad]").val();
            var b = $("input[id=precio]").val();
            res = (a * b) + res;
            document.getElementById("subTotal").value = a * b;
            document.getElementById("Total").value = res;
        } catch (e) {
        }
    }
    </script>
@endsection