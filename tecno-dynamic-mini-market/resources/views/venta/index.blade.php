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
                    <th scope="col">Fecha / Hora</th>
                    <th scope="col">Total</th>
                    <th scope="col">Recibo</th>
                    <th scope="col">Cambio</th>
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
                        {{ $venta->fecha }}
                    </td>

                    <td>
                        {{ $venta->total}}
                    </td>
                    <td>
                        {{ $venta->recibo }}
                    </td>
                    <td>
                        {{ $venta->cambio }}
                    </td>
                    <td class="eliminar">
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
                                    <div class="modal-footer eliminar">
                                        <form method="POST" id="idFormDeleteSale"
                                            action="{{url('/venta/'.$venta->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" id="idButtDelete" disabled
                                                class="btn btn-danger float-right">Borrar</button>
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
        <div class="paginacion">
            {{$ventas->links()}}
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("button[id=idButtDelete]").prop("disabled", false);
});
$(function() {
    $(document).on("click", "#idButtDelete", function() {
        $(this).prop("disabled", true);
        $(this).closest('tr').find('form[id="idFormDeleteSale"]').submit();
    })


});
</script>
@endsection