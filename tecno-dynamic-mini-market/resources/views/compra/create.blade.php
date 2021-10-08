@extends('layouts.panel')
@section('subtitulo','compras')
@section('content')

<head>
    <title>Ajax Autocomplete Textbox in Laravel using JQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva Orden de Compra</h3>
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

        <style>
        .menor {
            color: #D60202;
        }

        .estado-nulo {
            color: #D60202;
        }
        </style>


        <form action="{{ url('/compra/registrarCompra')}}" id="idFormCreateBuy" method="post">
            {{csrf_field()}}
            <div class="col-md-12 mx-auto">


                <div class='row'>
                    <div class="col-6">
                        <label form="comprobante">Comprobante</label>
                        <input class="form-control" type="text" name="comprobante" id="comprobante"
                            placeholder="Ingrese el comprobante" value="{{ old('comprobante') }}">

                        {!! $errors->first('comprobante','<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="col-6">

                        <label form="tipo_compra">Tipo de compra</label>
                        <select class="form-control {{$errors->has('tip0_compra')?'is-invalid':'' }}" name="tipo_compra"
                            id="tipo_compra">
                            <option selected value="Contado">Contado</option>
                            <option valur="Credito">Credito</option>
                        </select>
                        {!! $errors->first('tipo_compra','<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <label form="sucursal">Sucursal</label>
                        <select name="sucursal_origen" id="sucursal_origen"
                            class="form-control {{$errors->has('sucursal')?'is-invalid':''}}"
                            onkeyup="validarSucursal()">

                            @foreach($sucursal as $sucursal)
                            <option {{old('sucursal') == $sucursal->id ? "selected" : ""}} value="{{$sucursal->id}}">
                                {{$sucursal->nombre}}</option>
                            @endforeach
                        </select><span id="estadoSucursal"></span>
                        {!! $errors->first('sucursal','<div class="invalid-feedback">:message</div>') !!}
                        <div class="col-5">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="nanombre_contactome">Fecha</label>
                            <input class="form-control" type="datetime-local" name="fecha" readonly value="" id="fecha"
                                onblur="validarFecha()">
                        </div>
                    </div>
                </div>
            </div>

            @include('compra.table.table')

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

            });
            </script>

            <div class="col-md-12 mx-auto ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label form="total">Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="float" class="form-control" placeholder="100" aria-label="Username"
                                    id="total" name="total" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="recibo">Pagar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"  autocomplete="off" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="float" value="0" onclick="if(this.value=='0') this.value=''"
                                    onBlur="devolver()" onkeyup="validarRecibo()" require class="form-control"
                                    id="recibo" name="recibo">
                            </div>
                            <span id="estadoRecibo"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label form="cambio">Cambio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="float" autocomplete="off" class="form-control" aria-label="Username" id="cambio"
                                    name="cambio">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label form="observaciones">Observaciones</label>
                    <textarea class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label form="responsable_compra">Responsable de compra</label>
                            <input type="text" name="responsable_compra" autocomplete="off" class="form-control" type="url"
                                id="responsable_compra" placeholder="001-cbba" readonly
                                value="{{ auth()->user()->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="div text-center">
                <span id="stateForm"></span>
            </div>
            <button type="button" id="idButtonSubmitForm" onClick="validarTodo()" disabled
                class="btn btn-success my-2 my-sm-0">
                Guardar
            </button>
            <a href="{{ url('/compra')}}" class="btn btn-primary my-2 my-sm-0">Atras</a>
        </form>
    </div>

</div>
</div>

<script>
function validarTodo() {
    if (existeValor('cambio') && existeValor('recibo') && existeValor('recibo')) {
        $("#idFormCreateBuy").submit();
        $("#idButtonSubmitForm").prop("disabled", true)
    } else {
        $("#stateForm").html("<h5 class='menor'>Revise todos los campos </h5>");

    }
}

function existeValor($dato) {
    var aux = document.getElementById($dato).value;
    if (aux == "" || aux == "0" || aux == "0.00") {
        return false;
    }else{
        return true;
    }

   
}

$(document).ready(function() {
    $("#idButtonSubmitForm").prop("disabled", false);
    $('#nombre_contacto').keyup(function() {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '/autocomplete',
                method: 'POST',
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#countryList').fadeIn();
                    $('#countryList').html(data);
                }
            });
        }
    });

    $(document).on('click', 'li', function() {
        $('#nombre_contacto').val($(this).text());
        $('#countryList').fadeOut();
    });

});

function validarSucursal() {

    var cod = document.getElementById("sucursal_origen").value;
    //console.log(cod);
    if (cod != "Elige una Sucursal de Origen") {
        $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'> </h5></span>");
    } else {
        $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal</h5></span>");
    }
}

function validarFecha() {
    const date = new Date(),
        ten = (i) => ((i < 10 ? '0' : '') + i),
        YYYY = date.getFullYear(),
        MTH = ten(date.getMonth() + 1),
        DAY = ten(date.getDate()),
        HH = ten(date.getHours()),
        MM = ten(date.getMinutes()),
        SS = ten(date.getSeconds())
    // MS = ten(date.getMilliseconds())

    document.getElementById("fecha").value = `${YYYY}-${MTH}-${DAY}T${HH}:${MM}`;
}
setInterval(validarFecha, 30000);


function devolver() {
    try {
        $("#cambio").val(($("#recibo").val() - $("#total").val()).toFixed(2));
    } catch (e) {}
}

function validarRecibo() {
    var a = document.getElementById("cambio").value;
    var b = document.getElementById("recibo").value;
    var c = document.getElementById("total").value;

    if ((b - c) < 0) {

        $("#estadoRecibo").html(
            "<span  class='menor'><h5 class='menor'> Monto a pagar no puede ser menor al Total</h5></span>");
    } else {
        $("#estadoRecibo").html("<span  class='menor'><h5 class='menor'>  </h5></span>");


    }

}
</script>


@endsection