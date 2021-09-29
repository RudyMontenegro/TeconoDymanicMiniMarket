@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')

<div class="card shadow" style="background-color:#ffffff; color: rgb(0, 0, 0); font color: yellow !important">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva Venta</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('venta') }}" class="btn btn-sm btn-danger">Canselar y volver</a>
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
        <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <script>
        function validaComprobante() {

            if ($("#comprobante").val() == "") {
                $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            } else {
                if ($("#comprobante").val().length < 3) {
                    $("#estadoComprobante").html(
                        "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                } else {
                    if ($("#comprobante").val().length > 50) {
                        $("#estadoComprobante").html(
                            "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    } else {
                        var re = new RegExp("^[0-9a-zA-Z ]+$");
                        if (!re.test($("#comprobante").val())) {
                            $("#estadoComprobante").html(
                                "<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z] y [0-9]</h5></span>"
                            );
                        } else {
                            $("#estadoComprobante").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }
                    }

                }
            }
        }

        function validarCliente() {

            if ($("#nombre_contacto").val() == "") {
                $("#SpanValidacionCliente").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            } else {
                if ($("#nombre_contacto").val().length < 3) {
                    $("#SpanValidacionCliente").html(
                        "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                } else {
                    if ($("#nombre_contacto").val().length > 50) {
                        $("#SpanValidacionCliente").html(
                            "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                    } else {
                        var re = new RegExp("^[a-zA-Z ]+$");
                        if (!re.test($("#nombre_contacto").val())) {
                            $("#SpanValidacionCliente").html(
                                "<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>"
                            );
                        } else {
                            $("#SpanValidacionCliente").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                        }

                    }

                }
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

        function validarSucursal() {

            var cod = document.getElementById("sucursal_origen").value;
            //console.log(cod);
            if (cod != "Elige una Sucursal de Origen") {
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'> </h5></span>");
            } else {
                $("#estadoSucursal").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal</h5></span>");
            }
        }
        </script>
        <style>
        .menor {
            color: #D60202;
        }

        .estado-nulo {
            color: #D60202;
        }
        </style>

        <form action="{{ url('venta') }}" id="idform" method="post">

            {{ csrf_field()}}

            <div class="col-md-12 mx-auto ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nit">NIT</label>
                            <input type="number" list="datalistOptionsNit" placeholder="Escriba para buscar..."
                                name="nit" id="nit" value="{{ old('nit')}}" class="form-control">
                            <datalist id="NitList">
                            </datalist>
                            <span id="estadoCodigo2"></span>

                        </div>
                        <script>
                        $('#nit').keyup(function() {
                            var query = $(this).val();
                            if (query != '') {
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: '/autoCompleteNit',
                                    method: 'POST',
                                    data: {
                                        query: query,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#NitList').fadeIn();
                                        $('#NitList').html(data);
                                    }

                                });
                            }
                        });
                        </script>
                    </div>
                    <div class="col-6">
                        <label for="nombre_empresa">Cliente</label>
                        <input class="form-control" name="nombre_contacto" onkeyup="validarCliente()"
                            list="datalistOptionsName" id="nombre_contacto" placeholder="Escriba para buscar...">
                        <span id="SpanValidacionCliente"></span>
                        <datalist id="countryList">
                        </datalist>

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="nanombre_contactome">Fecha</label>
                            <input class="form-control" type="datetime-local" name="fecha" readonly value="" id="fecha"
                                onblur="validarFecha()">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="direccion">Tipo de Venta</label>
                            <select class="form-control {{$errors->has('tip0_compra')?'is-invalid':'' }}"
                                name="tipo_compra" id="tipo_compra">
                                <option value="Contado">Contado</option>
                                <option valur="Credito">Credito</option>
                            </select>
                            {!! $errors->first('tipo_compra','<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sucursal_origen">Sucursal</label>
                        <select name="sucursal_origen" id="sucursal_origen" onkeyup="validarSucursal()"
                            onchange="validarSucursal()"
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
                        <div class="form-group">
                            <label for="comprobante">Comprobante</label>
                            <input type="text" name="comprobante" id="comprobante" class="form-control"
                                value="{{ old('comprobante')}}" onkeyup="validaComprobante()"><span
                                id="estadoComprobante"></span>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            @include('venta.table.table')
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
                            <label for="email">Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="number" class="form-control" id="total" name="total">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nit">Responsable de venta</label>
                            <input type="text" name="responsable_venta" class="form-control" type="url"
                                placeholder="001-cbba" readonly value="{{ auth()->user()->name }}">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="ClickValidadarImprimir()" class="btn btn-info">Validar e
                    imprimir</button>
                <button type="button" id="idBotonGuardar" onclick="guardarForm()" disabled class="btn btn-primary">
                    Guardar
                </button>
            </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
$(function() {
  //  $(':input[type="submit"]').prop('disabled', true);
});

function existeValorCreate($dato) {
    var dato = document.getElementById($dato).value;
    if (dato == "") {
        return false;
    }
    return true;
}

function existeSucursalCreate() {
    var cod = document.getElementById("sucursal_origen").value;
    if (cod == "Elige una Sucursal de Origen") {
        return false;
    } else {
        return true;
    }
}

function ClickValidadarImprimir() {
    
    if (existeValorCreate('nit') && existeValorCreate('nombre_contacto') && existeValorCreate('comprobante') &&
        existeValorCreate('total') && existeSucursalCreate()) {
        // alert("me llamabas?");
        $('#idform').find(':input').prop('disabled', 'disabled');//accede todos los inputs del formulario
      //  $('#idform').find(':select')
       //$('#nit').prop('readonly', true);
       //$('#nombre_contacto').prop('readonly', true);
      //$('#idform').submit();
      $('#idBotonGuardar').prop('disabled', false);
       
    } else {
        alert("Revise todos los campos del formulario")
    }
}
function guardarForm() {
    $('#idform').find(':input').prop('disabled', false);
    $('#idform').submit();
}


$("form").bind("keypress", function(e) {
    if (e.keyCode == 13) {
        $("#btnSearch").attr('value');
        //add more buttons here
        return false;
    }
});
</script>
@endsection