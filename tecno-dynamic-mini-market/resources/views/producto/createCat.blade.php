@extends('layouts.panel')

@section('subtitulo','sucursal')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="card shadow">
    <div class="card-header border-0">
        <h1 class="text-center">REGISTRO DE NUEVA CATEGORIA</h1>

    </div>
    <div class="col-md-6 mx-auto ">
        <h2>
            @include('Mensaje.nota')
        </h2>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
    function comprobarCategoria() {
        $("#loaderIcon").show();

        jQuery.ajax({
            url: "/categoria/validar",
            data: {
                "_token": "{{ csrf_token() }}",
                "nombre": $("#nombre").val(),
            },
            asycn: false,
            type: "POST",
            success: function(data) {
                $("#estadoCategoria").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {
                console.log('no da');
            }
        });
    }

    function validarNombre() {

        if ($("#nombre").val().length < 3) {
            $("#estadoCategoria").html(
                "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
        } else {
            if ($("#nombre").val().length > 50) {
                $("#estadoCategoria").html(
                    "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
            } else {
                var re = new RegExp("^[0-9a-zA-Z ]+$");
                if (!re.test($("#nombre").val())) {
                    $("#estadoCategoria").html(
                        "<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z] y [0-9]</h5></span>"
                    );
                } else {
                    $("#estadoCategoria").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
            }

        }
    }

    function validardescripcion() {

        if ($("#descripcion").val() == "") {
            $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'> </h5></span>");
        } else {
            if ($("#descripcion").val().length < 3) {
                $("#estadoDescripcion").html(
                    "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
            } else {
                if ($("#nombre").val().length > 50) {
                    $("#estadoDescripcion").html(
                        "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
                } else {
                    var re = new RegExp("^[0-9a-zA-Z ]+$");
                    if (!re.test($("#descripcion").val())) {
                        $("#estadoDescripcion").html(
                            "<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                    } else {
                        $("#estadoDescripcion").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }

                }

            }
        }

    }
    $(document).ready(function() {
        $("#idButtonSaveCreate").prop("disabled", false);
       
    });

    function validarTodo() {
        if (existeValor('nombre')) {
            event.preventDefault();
        } else {
            if (existeValor('descripcion')) {
                event.preventDefault();
            } else {
                    $("#idFormCreate").submit();
                    $("#idButtonSaveCreate").prop("disabled",true);
            }
        }
    }

    function existeValor($dato) {
        var boolean = false;
        var aux = document.getElementById($dato).value;
        if (aux == "") {
            boolean = true;
        }
        return boolean;
    }
    </script>
    <style>
    .estado-no-disponible-usuario {
        color: #D60202;
    }

    .estado-disponible-usuario {
        color: #2FC332;
    }

    .menor {
        color: #D60202;
    }
    </style>
    <form action="{{url('/producto/registrarCategoria')}}" class="form" id="idFormCreate" method="post"
        enctype="multipart/form-data">

        {{ csrf_field()}}



        <div class=" row justify-content-center">
            <div class="col-6">
                <label for="nombre" class="control-label">{{'Nombre'}}</label>
                <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre"
                    id="nombre" value="{{ isset($sucursal->nombre)?$sucursal->nombre:old('nombre')  }}"
                    autocomplete="off" onBlur="comprobarCategoria()" onBlur="validarNombre()"><span
                    id="estadoCategoria"></span>
                {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class=" row justify-content-center">
            <div class="col-6">

                <label for="descripcion" class="control-label">{{'Descripcion'}}</label>
                <input type="text" class="form-control  {{$errors->has('descripcion')?'is-invalid':'' }}"
                    name="descripcion" autocomplete="off" id="descripcion"
                    value="{{ isset($sucursal->descripcion)?$sucursal->descripcion:old('descripcion') }}"
                    onkeyup="validardescripcion()"><span id="estadoDescripcion"></span>
                {!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}


            </div>
        </div>

        <br>
        <br>
        <div class=" row justify-content-center">
            <div class="col-5">
                <a href="{{url('producto')}}" class="btn btn-primary" style="position: static">Regresar</a>
            </div>
            <div class="col-5">
                <button type="button" id="idButtonSaveCreate" disabled onClick="validarTodo()"
                    class="btn btn-success float-right">Guardar"</button>
            </div>
        </div>

        <br>
    </form>
</div>

<br>

</div>


@endsection