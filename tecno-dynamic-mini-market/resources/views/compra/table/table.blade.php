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
        .menor {
            color:#D60202;
        }
        .estado-nulo{
            color:#D60202;
        }
    </style>
    <div class="table-responsive">
        <table class="table" id="tabla">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Codigo de producto | </th>
                    <th scope="col">Nombre | </th>
                    <th scope="col">Unidad | </th>
                    <th scope="col">Cantidad | </th>
                    <th scope="col">Precio | </th>
                    <th scope="col">Subtotal | </th>
                    <th scope="col">Eliminar | </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <input class="form-control" name="codigoI[]" id="codigoI" onkeyup="existe()" list="codigo">
                        <datalist id="codigo">
                        </datalist>
                        <span id="estadoCodigo"></span>
                        <span id="estadoCodigoI"></span>
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nombre[]" id="nombre">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="unidad[]" id="unidad" onkeyup="validarUnidad()">
                        <span id="estadoUnidad"></span>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="cantidad[]" onBlur="calcular()" id="cantidad">
                    </td>
                    <td>
                        <div class="input-group">
                             <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Bs.</span>
                            </div>
                        <input type="number" class="form-control" onBlur="calcular()" name="precio[]" id="precio">
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Bs.</span>
                            </div>
                          <input type="number" class="form-control" name="subTotal[]" id="subTotal">
                        </div>
                    </td>
                    <td class="eliminar" id="deletRow" name="deletRow">
                        <button class="btn btn-icon btn-danger" type="button">
                            <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-lg btn-block" id="adicional" name="adicional">Añadir</button>
    </div>

    <script>
        $("#sucursal_origen").change(event => {
            $.get(`envioP/${event.target.value}`, function(res, sta) {
                $("#codigo").empty();
                $("#codigo").append(`<option > Elige el codigo de producto </option>`);
                res.forEach(element => {
                    $("#codigo").append(
                        `<option> ${element.codigo} </option>`
                    );
                });
            });
        });
        $("#codigoI").change(event => {
            $.get(`envioN/${$("#codigoI").val()}`, function(res, sta) {
                $("#nombre").empty();
                $("#nombre").val(res[0].nombre);
            });
        });
        </script>
        <script>
        var res = 0;
        function calcular() {
            try {
                var a = $("input[id=cantidad]").val();
                var b = $("input[id=precio]").val();
                res = (a * b) + res;
                document.getElementById("subTotal").value = a * b;
                document.getElementById("total").value = res;
            } catch (e) {}
        }
        </script>
        <script>
        function limpiarCampos() {
           
            $("#codigoI").val('');
            $("#unidad").val('');
            $("#nombre").val('');
            $("#cantidad").val('');
            $("#precio").val('');
            $("#subTotal").val('');
        }
        var bb = 0;
        $(function() {
            $("#adicional").on('click', function() {
                $("#tabla tbody tr:eq(0)").clone().appendTo("#tabla").find('input').attr('readonly', true);
                bb = bb + 1;
                limpiarCampos();
            });
            $(document).on("click", ".eliminar", function() {
                if (bb > 0) {
                    var variableRestar  = $(this).closest('tr').find('input[id="subTotal"]').val();
                    var parent = $(this).parents().get(0); 

                    //$(parent).remove();
                    // bb = bb - 1;
                    res = res - variableRestar;
                $("#total").val(res); 
                $(parent).remove();
                bb = bb - 1;
            }else{
                $(this).parents().find('input').attr('readonly', false);
                res = 0;
                $("#total").val(res); 
                limpiarCampos();
            }
            });
        });
        function existe(){
        var e = document.getElementById("sucursal_origen");
        var str = e.options[e.selectedIndex].text;
        if(str == "Elige una Sucursal de Origen"){
            $("#estadoCodigo").html("<span  class='menor'><h5 class='menor'>Seleccione una sucursal de origen </h5></span>");
            $("#estadoCodigoI").html("<span  class='menor'><h5 class='menor'> </h5></span>");
        }else{
            $("#estadoCodigo").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                $("#nombre").val('');
                validarNombre();
            
        }
    }
    
    function validarUnidad() {
        var prueba = document.getElementById("unidad");
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
                        prueba.style.borderColor = '#cad1d7';
                        $("#estadoUnidad").html("<span  class='menor'><h5 class='menor'> </h5></span>");
                    }
                }
            }
            
        }
    }
    function validarNombre() {
        var cod = document.getElementById("sucursal_origen").value;
        jQuery.ajax({
            url: "/compra/llenar",
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
        </script>