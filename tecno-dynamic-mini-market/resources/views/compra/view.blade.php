@extends('layouts.panel')
@section('subtitulo','compras')
@section('content') 

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
               <div class="col">
                   <h3 class="mb-0">Orden de Compra</h3>
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
               <div class = 'row'>
                      <div class="col-6">
                          <label form="comprobante">Comprobante</label>
                          <input class="form-control" disabled  type="text" name="comprobante" id="comprobante" 
                                  placeholder="Ingrese el comprobante" value="{{ isset($compra->comprobante)?$compra->comprobante:old('comprobante') }}">

                             {!!  $errors->first('comprobante','<div class="invalid-feedback">:message</div>') !!}
                        </div>   
                        <div class="col-6">
            
                            <label form="tipo_compra">Tipo de compra</label>
                            <input class="form-control" disabled  name="tipo_compra" id="tipo_compra" value="{{ isset($compra->tipo_compra)?$compra->tipo_compra:old('tipo_compra') }}">
                         
                               {!!  $errors->first('tipo_compra','<div class="invalid-feedback">:message</div>') !!}           
                         </div>
               </div>
              <div class="row">

                   <div class="col-6">
                         <div class="form-group">
                            <label form="fecha">Fecha</label>
                            <input class="form-control text-dark" disabled name="fecha"
                                    id="fecha" value="{{ isset($compra->fecha)?$compra->fecha:old('responsable_compra') }}">
                         </div>
                  </div>
              </div>  
         </br>  
           @include('compra.table.tableShow')
          </br>
            <div class="col-md-12 mx-auto ">
                   <div class="row">
                         <div class="col-6">
                             <div class="form-group">
                                 <label form="total">Total</label>
                                     <div class="input-group">
                                           <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">Bs.</span>
                                           </div>
                                               <input type="number" class="form-control" disabled placeholder="100" aria-label="Username" id="total" name="total"
                                                       aria-describedby="basic-addon1"  value="{{ isset($compra->total)?$compra->total:old('total') }}">
                                     </div>
                              </div>
                          </div>
                   </div>
                   <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label form="total">Pagar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="float" class="form-control"  readonly value=" {{ $compra->recibo }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label form="total">Cambio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Bs.</span>
                                </div>
                                <input type="float" class="form-control"  readonly value=" {{ $compra->cambio }}">
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class="form-group">
                    <label form="observaciones">Observaciones</label>
                    <input  class="form-control name="observaciones" id="observaciones" rows="3" readonly value=" {{ $compra->observaciones }}">
             </div>
                  <div class="row">
                         <div class="col-6">
                                  <div class="form-group">
                                        <label form="responsable_compra">Responsable de compra</label>
                                        <input type="text" name="responsable_compra" class="form-control" type="url" id="responsable_compra" placeholder="001-cbba"
                                               readonly value="{{ isset($compra->responsable_compra)?$compra->responsable_compra:old('responsable_compra') }}">
                                  </div>
                         </div>
                   </div>

                     <a href="{{ url('/compra')}}" class="btn btn-primary my-2 my-sm-0">Atras</a>
            </div>

        </div>
</div>
@endsection