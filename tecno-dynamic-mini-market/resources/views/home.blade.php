@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notificaciones</div>
               
                <div class="card-body">
                    <h2 class="text-center text-dark">Stock</h2>
                   
                        @foreach ($stock as $stock)
                            <h3 style="color: rgb(228, 105, 105)">!!!Stock agotado¡¡¡ tiene {{$stock->cantidad}} productos de {{$stock->nombre}}</h3>
                        @endforeach
                <h2 class="text-center text-dark">Vencimiento Semanal</h2>
                 
                @foreach ($semana as $semana)
                    <h3 style="color: rgb(55, 95, 32)">{{$semana->nombre}} vencera el {{$semana->fecha_vencimiento}}</h3>
                @endforeach

                    
                <h2 class="text-center text-dark">Vencimiento Bimestral</h2>    
                @foreach ($mes as $mes)
                    <h3 style="color: rgb(111, 105, 228)">{{$mes->nombre}} vencera el {{$mes->fecha_vencimiento}}</h3>
                @endforeach
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
