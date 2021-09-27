@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">EDITAR PROVEEDOR</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('proveedor') }}" class="btn btn-sm btn-danger">Volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('proveedor/'.$proveedor->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="disabledTextInput">Nombre de la empresa</label>
                <input type="disabledTextInput" name="nombre_empresa" class="form-control"
                    value="{{ old('nombre_empresa',$proveedor->nombre_empresa)}}" required>
            </div>
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="text" name="nit" class="form-control" value="{{ old('nit',$proveedor->nit)}}" required>
            </div>
            <div class="form-group">
                <label for="nanombre_contactome">Nombre de contacto</label>
                <input type="text" name="nombre_contacto" class="form-control"
                    value="{{ old('nombre_contacto',$proveedor->nombre_contacto)}}" required>
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control"
                    value="{{ old('direccion',$proveedor->direccion)}}">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" type="tel"
                    value="{{ old('telefono',$proveedor->telefono)}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" type="email"
                    value="{{ old('email',$proveedor->email)}}" required>
            </div>
            <div class="form-group">
                <label for="web_site">Sitio web</label>
                <input type="text" name="web_site" class="form-control" type="url"
                    value="{{ old('web_site',$proveedor->web_site)}}">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" name="categoria" class="form-control"
                    value="{{ old('categoria',$proveedor->categoria)}}">
            </div>
        </form>
    </div>
</div>
@endsection