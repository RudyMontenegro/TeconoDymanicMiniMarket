<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>
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
        <p><strong>LISTA DE COMPRAS REGISTRADOS</strong></p>
    </header>
<body>

    <main>
        <table class="table table-striped text-left">
            <thead>
                <tr>
                <th scope="col">#</th>
                    <th scope="col">Comprobante</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo de compra</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Responsable de Compra</th>
                    <th scope="col">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($compras as $index => $compra)
                
                <tr>
                    <th scope="row">{{ $index+1}}</th>
                    <td>{{ $compra->comprobante }}</td>
                    <td>{{ $compra->nombre_empresa }}</td>
                    <td>{{ $compra->fecha}}</td>
                    <td>{{ $compra->tipo_compra}}</td>
                    <td>{{ $compra->nombre }}</td>
                    <td>{{ $compra->total }}</td>
                    <td>{{ $compra->responsable_compra }}</td>
                    <td>{{ $compra->observaciones }}</td>
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