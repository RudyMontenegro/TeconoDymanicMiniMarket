@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')



<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Lista de proveedores</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('proveedor/pdf')}}" class="btn btn-sm btn-warning">Exportar a PDF</a>
                <a href="{{ url('proveedor/create') }}" class="btn btn-sm btn-primary">Nuevo Proveedor</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Empresa</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                <tr>
                    <th scope="row">
                        {{ $proveedor->nombre_empresa }}
                    </th>
                    <td>
                        {{ $proveedor->nombre_contacto }}
                    </td>
                    <td>
                        {{ $proveedor->telefono }}
                    </td>
                    <td>
                        {{ $proveedor->email }}
                    </td>
                    <td>
                        <a href="{{ url('/proveedor/'.$proveedor->id.'/show') }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ url('/proveedor/'.$proveedor->id.'/edit') }}"
                            class="btn btn-sm btn-primary">Editar</a>
                        <button class="btn btn-sm btn-danger" type="submit" data-toggle="modal"
                            data-target="#exampleModal">Eliminar</button>
                        <!-- modaal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mensaje de Alerta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center">
                                            ¿Esta seguro de eliminar este producto?
                                        </h2>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{url('/proveedor/'.$proveedor->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger float-right">Borrar</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection