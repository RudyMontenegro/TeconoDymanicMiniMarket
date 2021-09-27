@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notificaciones</div>

                <div class="card-body">
                     
                    @foreach ($stock as $stock)
                        <h4 style="color: rgb(111, 105, 228)">Stock agotado tienes menos de 5 productos de {{$stock->nombre}}</h4>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
