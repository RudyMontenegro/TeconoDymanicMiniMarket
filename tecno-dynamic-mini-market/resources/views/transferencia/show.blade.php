@extends('layouts.panel')

@section('subtitulo','transferencia') 
@section('content')

<div class="card shadow" style="background-color:#ffffff; color: rgb(0, 0, 0); font color: yellow !important">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Detalle de Transferencia</h3>
            </div>
            <div class="col">
                <a href="{{url('transferencia/pdf/'.$transferencia->id)}}" class="btn btn-sm btn-warning float-right">Exportar a PDF</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
     
        <style>
            .menor {
                color:#D60202;
            }
        </style>
        

            <div class="col-md-12 mx-auto ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="comprobante">Comprobante</label>
                            <input type="text" disabled name="comprobante" id="comprobante" class="form-control text-dark" 
                            value="{{ isset($transferencia->comprobante)?$transferencia->comprobante:old('responsable') }}"
                            onkeyup="validaComprobante()"><span id="estadoComprobante"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="responsable">Responsable Transferencia</label>
                            <input type="text" disabled name="responsable" id="responsable" class="form-control text-dark" 
                            value="{{ isset($transferencia->responsable_transferencia)?$transferencia->responsable_transferencia:old('responsable') }}"
                            onkeyup="validarResponsable()"   ><span id="estadoTransferencia"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nanombre_contactome">Fecha</label>
                            <input class="form-control text-dark" disabled name="fecha" value="{{ isset($transferencia->fecha)?$transferencia->fecha:old('responsable') }}"
                                id="fecha" >
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="transferencia_origen">Transferencia Origen</label>
                        <input class="form-control text-dark" disabled name="origen" value="{{ isset($origen->nombre)?$origen->nombre:old('nombre_origen') }}"
                                id="origen" >
                        {!! $errors->first('transferencia_origen','<div class="invalid-feedback">:message</div>') !!}

                    </div>
                    <div class="col-6">
                        <label for="transferencia_destino">Transferencia Destino</label>
                        <input class="form-control text-dark" disabled name="destino" value="{{ isset($destino->nombre)?$destino->nombre:old('nombre_destino') }}"
                                id="destino" >
                        {!! $errors->first('transferencia_origen','<div class="invalid-feedback">:message</div>') !!}

                    </div>
                </div>
                <br>
            </div>

            <div class="col-md-12 mx-auto ">
                @include('transferencia.tablaShow')

                <br>
                <br>
                
            <div class="col text-center">
                <a href="{{ url('transferencia') }}" class="btn btn-primary ">Volver</a>
            </div>
            </div>
    </div>
</div>
@endsection