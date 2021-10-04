<style>
#formulario1 {
    margin: 0 auto;
    text-align: center;
    border-radius: 10px;
    border: 1px solid #ffffff;
    width: 800px;

}

.card .table td,
.card .table th {
    padding-right: 0.1rem;
    padding-left: 0.1rem;
}
</style>
<div class="table-responsive">
    <table class="table" id="tabla">
        <thead class="thead-light">
            <tr>
                <th scope="col">Codigo de Barras</th>
                <th scope="col">Nombre</th>
                <th scope="col">Unidad</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio/Bs.</th>
                <th scope="col">Subtotal/Bs.</th>

            </tr>
        </thead>
        <tbody id="tabla3">
            <span id="estadoBoton"></span>
            @foreach ($ventasDetalles as $ventasDetalle)
            <tr id="columna-0">
                <th>
                    <input class="form-control" readonly value="  {{ $ventasDetalle->codigo_barra }} ">
                </th>
                <td>
                    <input type="text" class="form-control" readonly value="  {{ $ventasDetalle->nombre }} ">
                </td>
                <td>
                    <input type="text" class="form-control" readonly value="  {{ $ventasDetalle->unidad }} ">
                </td>
                <td>
                    <input type="text" class="form-control" readonly value="  {{ $ventasDetalle->cantidad }} ">
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Bs.</span>
                        </div>
                        <input type="text" class="form-control" readonly value="  {{ $ventasDetalle->precio }} ">
                    </div>

                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Bs.</span>
                        </div>
                        <input type="text" class="form-control" readonly value="  {{ $ventasDetalle->sub_total }} ">
                    </div>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
