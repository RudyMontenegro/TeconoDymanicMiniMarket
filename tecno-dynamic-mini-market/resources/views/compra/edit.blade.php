@extends('layouts.panel')
@section('subtitulo','compras')
@section('content')


<div class="card shadow" style="background-color:#4F9BF6; color: white; font color: yellow !important">
   <div class="card-header border-0">
       <div class="row align-items-center">
              <div class="col">
                  <h3 class="mb-0">Editar Compra</h3>
               </div>

         </div>
    </div>  

    <div class="card-body">
 
       <form action="{{ url('/compra/edit/'.$compra->id)}}" method="post" enctype="multipart/form-data">
         {{csrf_field()}}
         {{ method_field('PATCH') }}
          <div class="col-md-12 mx-auto">

  
            <div class = 'row'>
                 <div class="col-6">
                      <label form="comprobante">Comprobante</label>
                      <input class="form-control {{$errors->has('nit')?'is-invalid':'' }}" type="text" name="comprobante" id="comprobante" 
                             placeholder="Ingrese el comprobante" value="{{ isset($compra->comprobante)?$compra->comprobante:old('comprobante') }}">

                       {!!  $errors->first('nit','<div class="invalid-feedback">:message</div>') !!}
                 </div>  

                 <div class="col-6">
                        <label form="proveedor">Proveedor</label>
                       <select name="proveedor" id="proveedor" class="form-control  {{$errors->has('proveedor')?'is-invalid':'' }}">   
                        <option selected disabled>Elige un Proveedor</option>
                            
                       </select>
                     {!!  $errors->first('proveedor','<div class="invalid-feedback">:message</div>') !!}
                       <div class="col-5">
                       </div>
                 </div> 
            </div>
            <div class="row">

                 <div class="col-6">
                    <div class="form-group">
                        <label for="nanombre_contactome">Fecha</label>
                        <input class="form-control" type="datetime-local" value="2018-11-23T10:30:00"
                            id="example-datetime-local-input">
                    </div>
                </div>
             
    
                 <div class="col-6">
                        <label form="tipo_compra">Tipo de compra</label>
                        <select class="form-control {{$errors->has('tip0_compra')?'is-invalid':'' }}" name="tipo_compra" id="tipo_compra">
                            <option value="Contado">Contado</option>
                            <option valur="Credito">Credito</option>
                     {!!  $errors->first('tipo_compra','<div class="invalid-feedback">:message</div>') !!}
                        </select>             
                 </div>

            </div>  
        </div>
              </br>  
               @include('compra.table.table')
              </br>
              <div class="col-md-12 mx-auto ">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="text" class="form-control" placeholder="100" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Observaciones</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ isset($compra->observaciones)?$compra->observaciones:old('observaciones') }}"></textarea>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="web_site">ID Sucursal</label>
                            <input type="text" name="web_site" class="form-control" type="url" placeholder="001-cbba"
                                readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nit">Responsable de compra</label>
                            <input type="text" name="web_site" class="form-control" type="url" placeholder="001-cbba"
                                readonly value="{{ auth()->user()->name }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>

        </div>
    </div>


    @endsection