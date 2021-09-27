<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lista de Proveedores</title>
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
    <p><strong>Recibo de venta</strong></p>
</header>

<body>

    <main>
        <table class="table table-striped text-left">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">NIT</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo de venta</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Comprobante</th>
                    <th scope="col">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td>{{ $venta->cliente }}</td>
                    <td>{{ $venta->nit }}</td>
                    <td>{{ $venta->fecha}}</td>
                    <td>{{ $venta->tipo_venta}}</td>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>{{ $venta->responsable_venta }}</td>
                    <td>{{ $venta->comprobante }}</td>
                    <td>{{ $venta->observaciones }}</td>
                </tr>
                
                <tr>
                    <td colspan="3"></td>
                    <th scope="col">Detaless:</th>
                    <th scope="col">Codigo de producto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Subtotal</th>
                </tr>
                @foreach($nombre as $index => $nom)
                <tr>
                    <td colspan="4"></td>
                    <td>
                        {{ $codigo_producto[$index] }}
                    </td>
                    <td>
                        {{ $nombre[$index] }}
                    </td>
                    <td>
                        {{ $cantidad[$index] }}
                    </td>
                    <td>
                        {{ $unidad[$index]}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <footer>
        <p><strong><span class="pagenum"></span></strong></p>
    </footer>
</body>

</html>