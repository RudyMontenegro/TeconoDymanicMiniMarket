@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')



<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Lista de transferencias</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('transferencia/registrarTransferencia') }}" class="btn btn-sm btn-primary">Nueva Transferencia</a>
            </div>
        </div>
        <br>
    <div class="table-responsive">
        <!-- Projects table -->
        <table  class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Comprobante</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transferencia as $transferencia)
            <tr>
                <th scope="row">
                    {{ $transferencia->comprobante }}
                </th>
                <td>
                    {{ $transferencia->responsable_transferencia }}
                </td>
                <td>
                    
                    <button class="btn btn-sm btn-danger" type="submit" data-toggle="modal"
<<<<<<< HEAD
                        data-target="#exampleModal2{{$transferencia->id}}">Eliminar</button>
=======
                        data-target="#exampleModal2{{$transferencia->id}}">Borrar</button>
>>>>>>> alex
                    <!-- modaal -->
                    <div class="modal fade" id="exampleModal2{{$transferencia->id}}" tabindex="-1" role="dialog"
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
                                        ¿Esta seguro de eliminar esta transferencia?
                                    </h2>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{url('/transferencia/'.$transferencia->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm float-right">Borrar</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/transferencia/informacion/'.$transferencia->id)}}"
                        class="btn btn-primary btn-sm float-left">
                        ver
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
    </div>

</div>
    </div>
</div>
@endsection