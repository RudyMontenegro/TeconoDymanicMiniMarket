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
        <p><strong>LISTA DE PROVEEDORES REGISTRADOS</strong></p>
    </header>
<body>

    <main>
        <table class="table table-striped text-left">
            <thead>
                <tr>
                <th scope="col">#</th>
                    <th scope="col">NIT</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Web</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proveedores  as $index => $proveedor)
                <tr>
                    <th scope="row">{{ $index +1 }}</th>
                    <td>{{ $proveedor->nit }}</td>
                    <td>{{ $proveedor->nombre_empresa}}</td>
                    <td>{{ $proveedor->nombre_contacto}}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>{{ $proveedor->web_site }}</td>
                    <td>{{ $proveedor->categoria }}</td>
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