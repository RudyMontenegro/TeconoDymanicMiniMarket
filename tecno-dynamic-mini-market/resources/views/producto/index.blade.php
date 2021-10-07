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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <a type="button" class="btn btn-primary btn-sm float-left" style="display: inline"
                href="{{url('/producto/registrarCategoria')}}">Nueva Categoria</a>
                <a type="button" class="btn btn-primary btn-sm float-left" style="display: inline"
                href="{{url('/producto/registrarProducto')}}">Nuevo Producto</a>
              
            </div>
        </div>
    </div>
</div>
   
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
                                    <th scope="col" class="text-center">Descripcion</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($categoria as $categorias)
                                    <td scope="row">{{$categorias->nombre}}</td>
                                    <td class="text-left">{{$categorias->descripcion}}</td>
                                    <td >

                                        <a href="{{url('/producto/categoria/editar/'.$categorias->id)}}" class="btn btn-sm btn-warning " >
                                            Editar 
                                        </a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
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
                                                        <form method="post" action="{{url('/producto/categoria/'.$categorias->id)}}"
                                                            style="display:inline">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button id="confirm" type="submit"
                                                                class="btn btn-sm btn-danger float-right ">Borrar</button>
                                                        </form>
                                                        <button type="button" class="btn-sm btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
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
                        <div >{{$categoria->appends(['producto' => $producto->currentPage()])->links()}}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<script>

jQuery('.myClickDisabledElm').bind('click',function(e){ 
    e.preventDefault(); 
})
</script>
        
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col text-right"> 
                    
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
                                @foreach ($producto as $productos)
                                    <td scope="row">{{$productos->codigo_barra}}</td>
                                    <td>{{$productos->nombre}}</td>
                                    <td>{{$productos->categoriaNombre}}</td>
                                    <td>
                                        <a href="{{ url('/producto/'.$productos->id) }}" class="btn btn-sm btn-info">Ver</a>

                                        <a href="{{url('/producto/editar/'.$productos->id)}}" class="btn btn-sm btn-warning">
                                            Editar
                                        </a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#exampleModal7{{$productos->id}}">
                                            Borrar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal7{{$productos->id}}" tabindex="-1" role="dialog"
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
                                                        <form method="post" action="{{url('/producto/'.$productos->id)}}"
                                                            style="display:inline">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button id="confirm" type="submit"
                                                                class="btn btn-sm btn-danger float-right btn-only1click">Borrar</button>
                                                        </form>
                                                        <button type="button" class="btn-sm btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       
                                    </td>

                                </tr>
                                @endforeach
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
                        <div >{{$producto->appends(['categoria' => $categoria->currentPage()])->links()}}</div>
                       
                    </div>
                </div>
            </div>
        </div>
                


    </div>
    

            

@endsection