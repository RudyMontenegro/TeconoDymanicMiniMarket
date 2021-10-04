@extends('layouts.panel')

@section('subtitulo','REPORTES')
@section('content')



<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <h1 class="text-primary text-center">REPORTE VENTAS Y COMPRAS</h1>
                <br>
                <form action="{{url('/reporte/busqueda')}}" class="form" method="post" enctype="multipart/form-data">

                    {{ csrf_field()}}

                    <div class="row justify-content-center">
                        <div class="col-3">
                            <label for="fecha_inicio" class="control-label float-left">{{'Fecha Inicio'}}</label>
                        </div>
                        <div class="col-3">
                            <label for="fecha_fin" class="control-label float-left">{{'Fecha Fin'}}</label>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        </div>
                        <div class="col-3">
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success float-left">Buscar</button>
                        </div>
                    </div>

                </form>
                <br>

            </div>
        </div>
    </div>
</div>

@endsection