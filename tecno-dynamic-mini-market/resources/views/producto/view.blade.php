@extends('layouts.panel')

@section('subtitulo','PRODUCTOS')
@section('content')


<div class="card shadow">
    <div class="card-header border-0">
         <h1 class="text-center">PRODUCTO</h1>
    </div>

    <div class="col-md-11 mx-auto "> 

        <div class="row justify-content-center">
            <div class="col-5">
        
                <label for="codigo" class="control-label">{{'Codigo'}}</label>
                <input type="text" disabled class="form-control  {{$errors->has('codigo')?'is-invalid':'' }}" name="codigo" id="codigo" 
                value="{{ isset($producto->codigo)?$producto->codigo:old('codigo') }}"
                >
                {!!  $errors->first('codigo','<div class="invalid-feedback">:message</div>') !!}
               
        
            </div> 
            <div class="col-5">
                <label for="codigoBarra"class="control-label">{{'Codigo Barra'}}</label>
                <input disabled type="text" class="form-control  {{$errors->has('codigoBarra')?'is-invalid':'' }}" name="codigoBarra" id="codigoBarra" 
                value="{{ isset($producto->codigo_barra)?$producto->codigo_barra:old('codigoBarra')  }}"
                >
            {!!  $errors->first('codigoBarra','<div class="invalid-feedback">:message</div>') !!}
            </div>
           
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="nombre"class="control-label">{{'Nombre'}}</label>
                <input disabled type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
                value="{{ isset($producto->nombre)?$producto->nombre:old('nombre') }}"
                >
                {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="categoria"class="control-label">{{'Categoria'}}</label>
                <input disabled type="text" class="form-control  {{$errors->has('categoria')?'is-invalid':'' }}" name="categoria" id="categoria" 
                value="{{ isset($categorias->categoriaName)?$categorias->categoriaName:old('categoria') }}"
                >
                {!!  $errors->first('categoria','<div class="invalid-feedback">:message</div>') !!}
            </div>
                           
            
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="marca"class="control-label">{{'Marca'}}</label>
                <input disabled type="text" class="form-control  {{$errors->has('marca')?'is-invalid':'' }}" name="marca" id="marca" 
                value="{{ isset($producto->marca)?$producto->marca:old('marca') }}"
                >
                {!!  $errors->first('marca','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="precioCosto"class="control-label">{{'Precio Costo'}}</label>
                <input disabled type="number" step="0.01" class="form-control  {{$errors->has('precioCosto')?'is-invalid':'' }}" name="precioCosto" id="precioCosto" 
                value="{{ isset($producto->precio_costo)?$producto->precio_costo:old('precioCosto') }}"
                >
                {!!  $errors->first('precioCosto','<div class="invalid-feedback">:message</div>') !!}
            </div>
               
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="precioVentaMayor"class="control-label">{{'Precio Venta Mayor'}}</label>
                <input disabled type="number" step="0.01"class="form-control  {{$errors->has('precioVentaMayor')?'is-invalid':'' }}" name="precioVentaMayor" id="precioVentaMayor" 
                value="{{ isset($producto->precio_venta_mayor)?$producto->precio_venta_mayor:old('precioVentaMayor')  }}"
                >
                {!!  $errors->first('precioVentaMayor','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="precioVentaMenor"class="control-label">{{'Precio Venta Menor'}}</label>
                <input disabled type="number" step="0.01" class="form-control  {{$errors->has('precioVentaMenor')?'is-invalid':'' }}" name="precioVentaMenor" id="precioVentaMenor" 
                value="{{ isset($producto->precio_venta_menor)?$producto->precio_venta_menor:old('precioVentaMenor')  }}"
                >
                {!!  $errors->first('precioVentaMenor','<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>  
        <div class="row justify-content-center">
            <div class="col-5">
                    <label for="cantidad"class="control-label">{{'Cantidad'}}</label>
                    <input disabled type="text" class="form-control  {{$errors->has('cantidad')?'is-invalid':'' }}" name="cantidad" id="cantidad" 
                    value="{{ isset($producto->cantidad)?$producto->cantidad:old('cantidad') }}"
                    >
                    {!!  $errors->first('cantidad','<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-5">
                    <label for="unidad"class="control-label">{{'Unidad'}}</label>
                    <input disabled type="text" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}" name="unidad" id="unidad" 
                    value="{{ isset($producto->unidad)?$producto->unidad:old('unidad') }}"
                    >
                    {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
                </div>
        </div> 
         
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="foto">Foto</label>
                <img src="{{asset('storage').'/'.$producto->ruta_foto}}" alt=""  width="750">
                {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                
            </div>
               
        </div> 
        <br>
        <div class="row">
            
            <div class="col-5">  
               
            </div>
            <div class="col-5">       
                <a href="{{url('producto')}}"class="btn btn-primary">Regresar</a>
            </div>
            <div class="col-5">       
                
            </div>
        </div>
        </div>
<br>
</div>


@endsection