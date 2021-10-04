@extends('layouts.panel')

@section('subtitulo','REPORTES')
@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <h1 class="text-primary text-center">VENTAS</h1>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Sucursal</th>
                                <th class="text-center">Observaciones</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Recibo</th>
                                <th class="text-center">Cambio</th>
                                <th class="text-center"></th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            
                                @foreach ($venta as $ventas)
                                <tr>
                                    
                                <td scope="row">{{$ventas->cliente}}</td>
                                <td class="text-center">{{$ventas->fecha}}</td>
                                <td class="text-left">{{$ventas->sucursales}}</td>
                                <td class="text-left">{{$ventas->observaciones}}</td>
                                <td class="text-center">{{$ventas->total}}</td>
                                <td class="text-center">{{$ventas->recibo}}</td>
                                <td class="text-center">{{$ventas->cambio}}</td>
                                <tr>
                                    <th class="text-center" ></th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Codigo Barra</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Nombre</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Cantidad</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Unidad</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Precio</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Sub Total</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)"></th>
                                </tr>
                                @php
                                    $consulta = DB::table('venta_detalles')
                                            ->select('venta_detalles.*')
                                            ->where('id_venta','=',$ventas->id)
                                            ->get();
                                @endphp
                                

                                    @foreach ($consulta as $consulta)
                                    <tr>
                                        <td scope="row"></td>
                                        <td class="text-center">{{$consulta->codigo_barra}}</td>
                                        <td class="text-center">{{$consulta->nombre}}</td>
                                        <td class="text-center">{{$consulta->cantidad}}</td>
                                        <td class="text-center">{{$consulta->unidad}}</td>
                                        <td class="text-center">{{$consulta->precio}}</td>
                                        <td class="text-center">{{$consulta->sub_total}}</td>
                                        <td class="text-center"></td> 
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    
                                </tr>
                                @endforeach
                            
                        </tbody>
                        
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col text-right">
                <h1 class="text-primary text-center">COMPRAS</h1>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Comprobante</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Tipo de Compra</th>
                                <th class="text-center">Sucursal</th>
                                <th class="text-center">Observaciones</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Recibo</th>
                                <th class="text-center">Cambio</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                            
                                @foreach ($compra as $compras)
                                <tr>
                                    
                                <td class="text-center">{{$compras->comprobante}}</td>
                                <td class="text-center">{{$compras->fecha}}</td>
                                <td class="text-left">{{$compras->tipo_compra}}</td>
                                <td class="text-left">{{$compras->sucursales}}</td>
                                <td class="text-left">{{$compras->observaciones}}</td>
                                <td class="text-center">{{$compras->total}}</td>
                                <td class="text-center">{{$compras->recibo}}</td>
                                <td class="text-center">{{$compras->cambio}}</td>
                                <tr>
                                    <th class="text-center" ></th>
                                    <th class="text-center" ></th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Codigo Barra</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Nombre</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Cantidad</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Unidad</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Precio</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)">Sub Total</th>
                                    <th class="text-center" style="background: rgb(245, 248, 250)"></th>
                                </tr>
                                @php
                                    $consulta = DB::table('compra_detalles')
                                            ->select('compra_detalles.*')
                                            ->where('id_compra','=',$compras->id)
                                            ->get();
                                @endphp
                                

                                    @foreach ($consulta as $consulta)
                                    <tr>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td class="text-center">{{$consulta->codigo_producto}}</td>
                                        <td class="text-center">{{$consulta->nombre}}</td>
                                        <td class="text-center">{{$consulta->cantidad}}</td>
                                        <td class="text-center">{{$consulta->unidad}}</td>
                                        <td class="text-center">{{$consulta->precio}}</td>
                                        <td class="text-center">{{$consulta->sub_total}}</td>
                                        <td class="text-center"></td> 
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    
                                </tr>
                                @endforeach
                            
                        </tbody>
                        </tbody>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                            </tr>
                        </thead>
                    </table>
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection