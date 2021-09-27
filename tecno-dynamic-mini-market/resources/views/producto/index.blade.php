@extends('layouts.panel')

@section('subtitulo','PRODUCTOS')
@section('content')

    <style>
        #medio{
            margin: 0 auto;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ffffff;
            width: 130px;
        }
        #formulario1 {
            margin: 0 auto;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ffffff;
            width: 800px;
    
        }
            .menor {
                color:#D60202;
            }
    </style>
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <a type="button" class="btn btn-primary btn-sm float-left" style="display: inline"
                href="{{url('/producto/registrarCategoria')}}">Nueva Categoria</a>

              
                    <button type="button"  class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#exampleModalLong">
                        Nuevo Producto
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="formulario1">Seleccione una Sucursal</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body"  >
                                   
                                    <label class="float-left" for="sucursal"><b>Sucursal</b></label>
                                    <select name="sucursal" id="sucursal" class="form-control {{$errors->has('sucursal')?'is-invalid':'' }}"  >
                                    <option selected disabled>Seleccione una Sucursal</option>
                                    @foreach ($sucursal as $sucursal)
                                        <option {{ old('sucursal') == $sucursal->id ? "selected" : "" }} value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                    @endforeach
                                    </select><span id="estadoSucursal"></span>
                                    
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <a type="button" class="btn btn-primary btn-sm float-left text-white" id="href"
                                     onclick="enviarForm()">Continuar</a>
                                   
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      

            </div>
        </div>
    </div>
</div>
   
        <script>
            function enviarForm(){
                var cod = document.getElementById("sucursal").value;
                if((cod =="Seleccione una Sucursal")){
                    $("#estadoSucursal").html("<span  class='menor float-left'><h5 class='menor'>Seleccione una sucursal</h5></span>");
                }else{
                    var urlOriginal = document.getElementById("href").href;
                    //Se obtiene el inicio del segundo URL, buscando "http"
                    var posSegundoUrl = urlOriginal.indexOf("http", 4)

                    //Se obtiene el primer URL
                    var primerUrl = urlOriginal.substring(0, posSegundoUrl);

                    //Se obtiene el segundo URL
                    var segundoUrl = urlOriginal.substring(posSegundoUrl);

                    //Se define un URL nuevo
                    var s = document.getElementById("sucursal").value;
                    var url = "/producto/registrarProducto/"+s;
                    console.log(url);
                    var urlNuevo =  "/producto/registrarProducto/"+s;

                    document.getElementById("href").setAttribute("href", primerUrl + urlNuevo);
                }
            }

            
           
        </script>

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col text-right">
                    <h1 class="text-primary text-center">CATEGORIAS</h1>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($categoria as $categorias)
                                    <td scope="row">{{$categorias->nombre}}</td>
                                    <td>{{$categorias->descripcion}}</td>
                                    <td>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger float-right" data-toggle="modal"
                                            data-target="#exampleModal2{{$categorias->id}}">
                                            Borrar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal2{{$categorias->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Mensaje de Alerta
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2 class="text-center">
                                                            ¿Esta seguro de eliminar esta categoria?
                                                        </h2>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{url('/producto/'.$categorias->id)}}"
                                                            style="display:inline">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button id="confirm" type="submit"
                                                                class="btn btn-sm btn-danger float-right">Borrar</button>
                                                        </form>
                                                        <button type="button" class="btn-sm btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{url('/producto/categoria/editar/'.$categorias->id)}}" class="btn btn-sm btn-warning float-right">
                                            Editar
                                        </a>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                        <div id="medio">{{$categoria->links()}}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

        
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
<<<<<<< HEAD
                <div class="col text-right">
=======
                <div class="col text-right"> 
>>>>>>> alex
                    <div class="col-4" style="display: inline-block;">
                        <select name="sucursal_show" id="sucursal_show"
                            class="form-control text-dark  {{$errors->has('sucursal_show')?'is-invalid':'' }}">
                            <option selected disabled>Seleccione una Sucursal</option>
                            @foreach ($sucursales as $sucursal)
                            <option {{ old('sucursal_show') == $sucursal->id ? "selected" : "" }} value="{{$sucursal->id}}" >{{$sucursal->nombre}}</option>
                            @endforeach 
                        </select>
                        
                    </div>
                    <h1 class="text-primary text-center">PRODUCTOS</h1>
                        
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Codigo Barra</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="miTabla">
                                
                            </tbody>
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
                
                                    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mensaje de Alerta
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h2 class="text-center">
                                                        ¿Esta seguro de eliminar este producto?
                                                    </h2>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="" id="eliminarProducto"
                                                        style="display:inline">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                    
                                                    <button id="confirm" type="submit" class="btn btn-danger btn-sm float-right">Borrar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Cancelar</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                <script>

                   

                    $("#sucursal_show").change(event => {
                        $.get(`producto/filtro/${$("#sucursal_show").val()}`, function(res, sta) {
                            console.log(res);
                            $("#miTabla").empty();
                            res.forEach(element => {
                                let tbody = document.getElementById('miTabla');
                                const ruta = '/producto/editar/';
                                let filaNueva = '<tr>' +
                                    '<td>' + element.codigo_barra + '</td>' +
                                    '<td>' + element.nombre + '</td>' +
                                    '<td>' + element.categoria + '</td>' +
                                    '<td>' + 

                                        '<button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal"'+
                                        'data-target="#exampleModal5" onclick="cambiarAction('+element.id+')" >'+
                                        'Borrar'+
                                        '</button>'

                                        +'<a id="href"  class="btn btn-warning float-right btn-sm text-white" onclick="enviarEditar('+element.id+')" >Editar</a>'
                                        +'<a id="href2" class="btn btn-info float-right btn-sm text-white" onclick="enviarVer('+element.id+')">Ver</a>'
                                    + '</td>' +
                                  '</tr>';
                                tbody.innerHTML += filaNueva;

                            }); 
                        });
                    });
                    

                    function enviarEditar(valor){
                        
                            var urlOriginal = document.getElementById("href").href;
                            //Se obtiene el inicio del segundo URL, buscando "http"
                            var posSegundoUrl = urlOriginal.indexOf("http", 4)
        
                            //Se obtiene el primer URL
                            var primerUrl = urlOriginal.substring(0, posSegundoUrl);
        
                            //Se obtiene el segundo URL
                            var segundoUrl = urlOriginal.substring(posSegundoUrl);
        
                            //Se define un URL nuevo
                            var url = "/producto/editar/"+valor;
                            console.log(url);
                            var urlNuevo =  "/producto/editar/"+valor;

                            window.location.href = primerUrl + urlNuevo;
                        
                    }
                    function enviarVer(valor){
                        
                        var urlOriginal = document.getElementById("href2").href;
                        //Se obtiene el inicio del segundo URL, buscando "http"
                        var posSegundoUrl = urlOriginal.indexOf("http", 4)
    
                        //Se obtiene el primer URL
                        var primerUrl = urlOriginal.substring(0, posSegundoUrl);
    
                        //Se obtiene el segundo URL
                        var segundoUrl = urlOriginal.substring(posSegundoUrl);
    
                        //Se define un URL nuevo
                        var url = "/producto/editar/"+valor;
                        console.log(url);
                        var urlNuevo =  "/producto/"+valor;

                        window.location.href = primerUrl + urlNuevo;
                    
                }

                function cambiarAction(valor){
                    document.getElementById("eliminarProducto").action = "/producto/"+valor;
                }
                </script>

    </div>
    

            

@endsection