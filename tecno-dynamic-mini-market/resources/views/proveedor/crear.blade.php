@extends('layouts.panel')
@section('subtitulo','proveedores')
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo Proveedor</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('proveedor') }}" class="btn btn-sm btn-danger">Canselar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body ">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ url('proveedor') }}" method="post">
            @csrf
            <div class="col-md-15 mx-auto">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="nombre_empresa">Nombre de la empresa</label>
                            <input type="text" name="nombre_empresa" class="form-control" placeholder="VTDfix"
                                value="{{ old('name')}}" required>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="nit">NIT</label>
                            <input type="text" name="nit" class="form-control" placeholder="123123"
                                value="{{ old('description')}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="nanombre_contactome">Nombre de contacto</label>
                            <input type="text" name="nombre_contacto" class="form-control" placeholder="Juan"
                                value="{{ old('name')}}" required>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" class="form-control"
                                placeholder="Av. Ayacucho y Av. Heroinas" value="{{ old('description')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" class="form-control" type="tel" placeholder="79999999"
                                value="{{ old('name')}}" required>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" class="form-control" type="email"
                                placeholder="juan@dominio.com" value="{{ old('description')}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="web_site">Sitio web</label>
                            <input type="text" name="web_site" class="form-control" type="url"
                                placeholder="www.vtdfix.com" value="{{ old('name')}}">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" name="categoria" class="form-control" placeholder="Material textil"
                                value="{{ old('description')}}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection