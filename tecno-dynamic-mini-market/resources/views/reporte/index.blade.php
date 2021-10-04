@extends('layouts.panel')

@section('subtitulo','REPORTES')
@section('content')



<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <h1 class="text-primary text-center">REPORTE</h1>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success float-left" id="buscador">Buscar</button>
                    </div>
                </div>
                <br>

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
                               
                            </tr>

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
</div>

@endsection