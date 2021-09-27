<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tranferencia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
@page {
    margin: 0cm 0cm;
    font-size: 3mm;
}

body {
    margin: 2cm 0cm 2cm;
}

header {
    position: fixed;
    top: 0cm;
    left: 0cm;
    right: 0cm;
    height: 2cm;
    background-color: #9561e2;
    color: white;
    text-align: center;
    line-height: 30px;
}

footer {
    position: fixed;
    bottom: 0cm;
    left: 0cm;
    right: 0cm;
    height: 1cm;
    background-color: #9561e2;
    color: white;
    text-align: center;
    line-height: 30px;
    
}
.pagenum:before {
        content: counter(page);
    }
</style>
<header>
    <br>
        <p><strong>LISTA DE TRANSFERENCIAS REGISTRADAS</strong></p>
    </header>
<body>

    <main>
        <h3 class="mb-0">Detalle de Transferencia</h3>
        <br>
        <h5>{{$transferencia->comprobante}}</h5>
        <div class="card shadow" style="background-color:#ffffff; color: rgb(0, 0, 0); font color: yellow !important">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        
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
        
                        <br>
                        <br>
                    </div>
            </div>
        </div>

    </main>
    <footer>
        <p><strong><span class="pagenum"></span></strong></p>
    </footer>
</body>

</html>