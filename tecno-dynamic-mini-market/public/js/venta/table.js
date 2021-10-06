
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
function SucursalExiste() {
    var e = document.getElementById("sucursal_origen");
    var str = e.options[e.selectedIndex].text;
    if (str == "Elige una Sucursal de Origen") {
        $("#estadoCodigo").html(
        "<span  class='menor'><h5 class='menor'>Seleccione una sucursal de origen </h5></span>");
        $("#estadoCodigoI").html("<span  class='menor'><h5 class='menor'> </h5></span>");
        $("#codigoI").val('');
    } else {
        //$("#estadoCodigo").html("<span  class='menor'><h5 class='menor'> </h5></span>");
        $("#nombre").val('');
        validarNombre();

    }
}

$("#sucursal_origen").change(event => {
    limpiarCampos();
    $("#estadoCodigo").html("<span  class='menor'><h5 class='menor'> </h5></span>");
});
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
    $("#unidad").val('');
    $("#nombre").val('');
    $("#cantidad").val('');
    $("#precio").val('');
    $("#subTotal").val('');
}
var bb = 0;
 
$(function() { /// se efecuta una ves termianada la recarga de la pagina
//    alert(bb);
//    validarNombre()
    $("#adicional").on('click', function() {
   
        $("#tabla tbody tr:eq(0)").clone().appendTo("#tabla").find('input').attr('readonly', true);
        bb = bb + 1;
        limpiarCampos();
  
    });
    $(document).on("click", ".eliminar", function() {
        if (bb > 0) {
            var variableRestar = $(this).closest('tr').find('input[id="subTotal"]').val();
            var parent = $(this).parents().get(0);// eliminar row
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
function validarNombre() {
    var cod = document.getElementById("sucursal_origen").value;
    jQuery.ajax({
        url: "/transferencia/llenar",
        data:{
            "_token": "{{ csrf_token() }}",
            "codigoI": $("#codigoI").val(),
            "sucursal":cod,
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


