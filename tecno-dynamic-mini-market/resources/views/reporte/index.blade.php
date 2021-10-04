@extends('layouts.panel')

@section('subtitulo','REPORTES')
@section('content')
<style>
    .menor{
        color:#D60202;
    }
</style>
    <script>
        function validarInicio(){
            if($("#fecha_inicio").val() == ""){
                $("#estadoInicio").html("<span  class='menor float-left'><h5 class='menor'>Seleccione una fecha inicio</h5></span>");
            }else{
                $("#estadoInicio").html("<span  class='menor float-left'><h5 class='menor'></h5></span>");
            }
            
        }
        function validarFin(){
            if($("#fecha_fin").val() == ""){
                $("#estadoFin").html("<span  class='menor float-left'><h5 class='menor'>Seleccione una fecha fin</h5></span>");
            }else{
                $("#estadoFin").html("<span  class='menor float-left'><h5 class='menor'></h5></span>");
            }
        }

        function validarEnvio(){
            if($("#fecha_inicio").val() > $("#fecha_fin").val()){
                $("#estadoInicio").html("<span  class='menor float-left'><h5 class='menor'>Revise las fechas de inicio y fin</h5></span>");
                event.preventDefault();
            }else{
                submit();
            }
        }
    </script>

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
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" onblur="validarInicio()">
                            <span id="estadoInicio"></span>
                        </div>
                        <div class="col-3">
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" onblur="validarFin()">
                            <span id="estadoFin"></span>
                        </div>
                        <div class="col-2">
                            <button onclick="validarEnvio()" class="btn btn-success float-left">Buscar</button>
                        </div>
                    </div>
                   
                </form>
                <br>

            </div>
        </div>
    </div>
</div>

@endsection