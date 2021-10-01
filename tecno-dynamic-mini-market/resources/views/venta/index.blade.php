@extends('layouts.panel')
@section('subtitulo','ventas')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Lista de ultimas ventas</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('venta/pdf')}}" class="btn btn-sm btn-warning">Exportar a PDF</a>
                <a href="{{ url('venta/create') }}" class="btn btn-sm btn-primary">Nueva Venta</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Nit</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <th scope="row">
                        {{ $venta->cliente }}
                    </th>
                    <td>
                        {{ $venta->nit }}
                    </td>
                    <td>
                        {{ $venta->tipo_venta }}
                    </td>
                    <td>
                        {{ $venta->nombre}}
                    </td>
                    <td>
                        {{ $venta->total }}
                    </td>
                    <td>
                        <a href="{{ url('/venta/'.$venta->id.'/show') }}" class="btn btn-sm btn-info">Detalles</a>
                        <button class="btn btn-sm btn-danger" type="submit" data-toggle="modal"
                            data-target="#exampleModal{{$venta->id}}">Eliminar</button>
                        <!-- modaal -->
                        <div class="modal fade" id="exampleModal{{$venta->id}}" tabindex="-1" role="dialog"
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
                                            ¿Esta seguro de eliminar esta venta?
                                        </h2>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{url('/venta/'.$venta->id) }}">
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