<style>
#formulario1 {
    margin: 0 auto;
    text-align: center;
    border-radius: 10px;
    border: 1px solid #ffffff;
    width: 800px;

}

.card .table td,
.card .table th {
    padding-right: 0.1rem;
    padding-left: 0.1rem;
}
</style>
<table class="table table-responsive" id="tabla">
    <thead class="thead-light">
        <tr>
            <th scope="col">Codigo de producto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Unidad</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody id="tabla3">
        <span id="estadoBoton"></span>
        <tr id="columna-0">
            <th>
                <input class="form-control" name="codigoI[]" id="codigoI" onkeyup="existe()" list="codigo">
                <datalist id="codigoDatalist">
                </datalist>
                <span id="estadoCodigo"></span>
                <span id="estadoCodigoI"></span>
            </th>
            <td>
                <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre[]"
                    id="nombre" value="{{ isset($transferencia->nombre)?$transferencia->nombre:old('nombre')  }}">
                <span id="estadoNombre"></span>
            </td>
            <td>
                <input type="text" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}" name="unidad[]"
                    onkeyup="validarUnidad()" id="unidad"
                    value="{{ isset($transferencia->unidad)?$transferencia->unidad:old('unidad')  }}"> <span
                    id="estadoUnidad"></span>
            </td>
            <td>
                <input type="integer" class="form-control  {{$errors->has('cantidad')?'is-invalid':'' }}"
                    name="cantidad[]" id="cantidad" onBlur="calcular()" onkeyup="validarCantidad()"
                    onblur="validarCantidadProducto()"
                    value="{{ isset($transferencia->cantidad)?$transferencia->cantidad:old('cantidad')  }}">
                <span id="estadoCantidad"></span>
            </td>
            <td>
                <input type="integer" class="form-control  {{$errors->has('precio')?'is-invalid':'' }}" name="precio[]"
                    onkeyup="validarPrecio()" onBlur="calcular()" id="precio"
                    value="{{ isset($transferencia->precio)?$transferencia->precio:old('precio')  }}"><span
                    id="estadoPrecio"></span>

            </td>
            <td>

                <input type="number" class="form-control  {{$errors->has('subTotal')?'is-invalid':'' }}"
                    name="subTotal[]" id="subTotal"
                    value="{{ isset($transferencia->subTotal)?$transferencia->subTotal:old('subTotal')  }}"><span
                    id="estadoSubTotal"></span>


            </td>
            <td class="eliminar" id="deletRow" name="deletRow">
                <button class="btn btn-icon btn-danger" type="button">
                    <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<button type="button" class="btn btn-success btn-lg btn-block" id="adicional" name="adicional">A??adir</button>
<script>
$("#codigoI").change(event => {
    $.get(`envioN/${$("#codigoI").val()}`, function(res, sta) {
        $("#nombre").empty();
        $("#nombre").val(res[0].nombre);
    });
});
$('#codigoI').keyup(function() {
    var query = $(this).val();
    var sucursalID = $("#sucursal_origen").val();
    if (query != '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '/autoCompleteCodigoP',
            method: 'POST',
            data: {
                query: query,
                _token: _token,
                sucursalID: sucursalID
            },
            success: function(data) {
                $('#codigoDatalist').fadeIn();
                $('#codigoDatalist').html(data);
            }
         
        });
    }
});
</script>

<script>
var res = 0;

function calcular() {
    try {
        var a = $("input[id=cantidad]").val();
        var b = $("input[id=precio]").val();
        res = (a * b) + res;
        $("#subTotal").val(a * b);
        $("#total").val(res);
    } catch (e) {}
}

function limpiarCampos() {
    $("#codigoI").val('');
    $("#nombre").val('');
    $("#cantidad").val('');
    $("#unidad").val('');
    $("#precio").val('');
    $("#subTotal").val('');
}
$("#sucursal_origen").change(event => {
    limpiarCampos();
    $("#estadoCodigo").html("<span  class='menor'><h5 class='menor'> </h5></span>");
});
var bb = 0;
var iman = 0;
$(function() {

    console.log(existeValor("codigoI"));
    $("#adicional").on('click', function() {
        if (!existeValor("codigoI") && !existeValor("nombre") && !existeValor("cantidad") && !
            existeValor("precio") && !existeValor("unidad") && !existeValor("subTotal")


        ) {
            iman = iman + 1;
            $("#tabla tbody tr:eq(0)").clone().appendTo("#tabla").attr("id", "columna-" + (iman)).find(
                'input').attr('readonly', true);
            limpiarCampos();
            bb = bb + 1;
            $('#deletRow').show();
        } else {
            vacio("codigoI");
            vacio("nombre");
            vacio("cantidad");
            vacio("unidad");
            vacio("precio");
            vacio("subTotal");

        }
    });


    $(document).on("click", ".eliminar", function() {
        if (bb > 0) {
            var variableRestar = $(this).closest('tr').find('input[id="subTotal"]').val();
            var parent = $(this).parents().get(0); // eliminar row
            //  alert(variable);
            res = res - variableRestar;
            $("#total").val(res);
            $(parent).remove();
            bb = bb - 1;
        } else {
            // $(this).find('input').attr('readonly', false);
            $("#codigoI").attr('readonly', false);
            $("#unidad").attr('readonly', false);
            $("#nombre").attr('readonly', false);
            $("#cantidad").attr('readonly', false);
            $("#precio").attr('readonly', false);
            $("#subTotal").attr('readonly', false);
            res = 0;
            $("#total").val(res);
            limpiarCampos();
        }
    });
});

function existeValor($dato) {
    var boolean = false;
    var aux = document.getElementById($dato).value;
    if (aux == "") {
        boolean = true;
    }
    return boolean;
}

function vacio($valor) {
    var dato = document.getElementById($valor).value;
    var prueba = document.getElementById($valor);
    if (dato == "") {
        prueba.style.borderColor = 'red';
        $("#estado" + $valor.charAt(0).toUpperCase() + $valor.slice(1)).html(
            "<span  class='menor'><h5 class='menor'>Campo obligatorio</h5></span>");
    } else {
        if (validarCantidad() || validarNombre() || validarPrecio() || validarUnidad()) {
            prueba.style.borderColor = '#cad1d7';
            $("#estado" + $valor.charAt(0).toUpperCase() + $valor.slice(1)).html(
                "<span  class='menor'><h5 class='menor'></h5></span>");
        }

    }
}

function validarUnidad() {
    var prueba = document.getElementById("unidad");
    var re = new RegExp("^[a-zA-Z ]+$");
    if ($("#unidad").val() == "") {
        $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
    } else {
        if ($("#unidad").val().length < 3) {
            $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
        } else {
            if ($("#unidad").val().length > 50) {
                $("#estadoUnidad").html(
                    "<span  class='menor'><h5 class='menor'>Ingrese de 3 a 50 caracteres</h5></span>");
            } else {
                if (!re.test($("#unidad").val()) || $("#unidad").val() == '-') {
                    $("#estadoUnidad").html(
                        "<span  class='menor'><h5 class='menor'>Solo se acepta caracteres [A-Z]</h5></span>");
                } else {
                    prueba.style.borderColor = '#cad1d7';
                    $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                }
            }
        }

    }
}

function validarCantidad() {
    var prueba = document.getElementById("cantidad");
    var re = new RegExp("^[0-9]+$");
    if ($("#cantidad").val() == "") {
        $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
    } else {
        if ($("#cantidad").val() <= 0) {
            $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
        } else {
            if (!re.test($("#cantidad").val()) || $("#cantidad").val() == 'e' || $("#cantidad").val() == '-') {
                $("#estadoCantidad").html(
                    "<span  class='menor'><h5 class='menor'>Cantidad ingresada incorrecta</h5></span>");
            } else {
                prueba.style.borderColor = '#cad1d7';

                $("#estadoCantidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");

            }
        }
    }
}

function validarPrecio() {
    var re = new RegExp("^[0-9]+$");
    var prueba = document.getElementById("precio");
    if ($("#precio").val() == "") {
        $("#estadoPrecio").html("<span  class='menor'><h5 class='menor'> </h5></span>");
    } else {
        if ($("#precio").val() <= 0) {
            $("#estadoPrecio").html("<span  class='menor'><h5 class='menor'>Cantidad debe ser mayor a 0</h5></span>");
        } else {
            if (!re.test($("#precio").val()) || $("#precio").val() == 'e' || $("#precio").val() == '-') {
                $("#estadoPrecio").html(
                    "<span  class='menor'><h5 class='menor'>Cantidad ingresada incorrecta</h5></span>");
            } else {
                prueba.style.borderColor = '#cad1d7';
                var a = document.getElementById("subTotal");
                a.style.borderColor = '#cad1d7';
                $("#estadoPrecio").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                $("#estadoSubTotal").html("<span  class='menor'><h5 class='menor'> </h5></span>");
               // calcular();
            }
        }
    }
}

function existe() {
    var e = document.getElementById("sucursal_origen");
    var str = e.options[e.selectedIndex].text;
    if (str == "Elige una Sucursal de Origen") {
        $("#estadoCodigo").html(
            "<span  class='menor'><h5 class='menor'>Seleccione una sucursal de origen </h5></span>");
        $("#estadoCodigoI").html("<span  class='menor'><h5 class='menor'> </h5></span>");
    } else {
        $("#nombre").val('');
        validarNombre();

    }
}

function validarNombre() {
    var cod = document.getElementById("sucursal_origen").value;
    jQuery.ajax({
        url: "/transferencia/llenar",
        data: {
            "_token": "{{ csrf_token() }}",
            "codigoI": $("#codigoI").val(),
            "sucursal": cod,
        },
        asycn: false,
        type: "POST",
        success: function(data) {
            $("#estadoCodigo").html(data);
            $("#loaderIcon").hide();

        },
        error: function() {
            console.log('no da');
        }
    });
}

function validarCantidadProducto() {
    var e = document.getElementById("sucursal_origen");
    var str = e.options[e.selectedIndex].text;
    if (!($("#codigoI").val() == "") && !(str == "Elige una Sucursal de Origen")) {
        var cod = document.getElementById("sucursal_origen").value;
        jQuery.ajax({
            url: "/transferencia/cantidadProducto",
            data: {
                "_token": "{{ csrf_token() }}",
                "codigoI": $("#codigoI").val(),
                "cantidad": $("#cantidad").val(),
                "sucursal": cod,
            },
            asycn: false,
            type: "POST",
            success: function(data) {
                $("#estadoCantidad").html(data);
                $("#loaderIcon").hide();

            },
            error: function() {
                console.log('no da');
            }
        });
    }

}
</script>