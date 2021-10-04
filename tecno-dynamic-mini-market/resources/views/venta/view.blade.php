@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')

<div class="card shadow" style="background-color:#ffffff; color: rgb(0, 0, 0); font color: yellow !important">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Detalles de Venta</h3>
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
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
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

        function caseSN() {
            if ($("#nombre_contacto").val() == "") {
                $("#nombre_contacto").val("Sin nombre")
                $("#SpanValidacionCliente").html("<span  class='menor'><h5 class='menor'> </h5></span>");
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
                            <label for="nanombre_contactome">Fecha</label>
                            <input class="form-control"   readonly
                                value="{{ $tabla->fecha }}" >
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="nombre_empresa">Cliente</label>
                        <input class="form-control" name="nombre_contacto" readonly value=" {{ $tabla->cliente }}">

                    </div>
                </div>
                <br>
            </div>
            @include('venta.table.tableView')
            <div class="col-md-12 mx-auto ">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input class="form-control"  readonly value=" {{ $tabla->total }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Recibo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input class="form-control"  readonly value=" {{ $tabla->recibo }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Cambio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input class="form-control"  readonly value=" {{ $tabla->cambio }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Observaciones</label>
                    <input class="form-control" readonly value=" {{ $tabla->observaciones }}" rows="3">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nit">Responsable de venta</label>
                            <input type="text" name="responsable_venta" class="form-control" type="url"
                                placeholder="001-cbba" readonly value="{{ $tabla->responsable_venta }}">
                        </div>
                    </div>
                </div>

            </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
function existeValorCreate($dato) {
    var dato = document.getElementById($dato).value;
    if (dato == "") {
        return false;
    }
    return true;
}

function CalcularCambio() {
    try {
        $("#cambio").val(($("#recibo").val() - $("#total").val()).toFixed(2));
    } catch (e) {}
}

function existeSucursalCreate() {
    var cod = document.getElementById("sucursal_origen").value;
    if (cod == "Elige una Sucursal de Origen") {
        return false;
    } else {
        return true;
    }
}

function guardarForm() {
    if (existeValorCreate('nombre_contacto') &&
        existeValorCreate('total') && existeSucursalCreate()) {
        $('#idform').submit();
    } else {
        alert("Revise todos los campos del formulario")
    }

}
</script>
@endsection