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
                    <th scope="col">Codigo de producto | </th>
                    <th scope="col">Nombre | </th>
                    <th scope="col">Unidad | </th>
                    <th scope="col">Cantidad | </th>
                    <th scope="col">Precio | </th>
                    <th scope="col">Subtotal | </th>
                </tr>
            </thead>
            <tbody id="tablaSS">
                <span id="estadoBoton"></span>
                @foreach ($comprasDetalles as $comprasDetalle)
                <tr id="columna-0">
                    <th>
                        <input class="form-control"  readonly value="  {{ $comprasDetalle->codigo_barra }} ">
                    </th>
                    <td>
                        <input type="text" class="form-control" readonly value="  {{ $comprasDetalle->nombre }} ">
                    </td>
                    <td>
                        <input type="text" class="form-control" readonly value="  {{ $comprasDetalle->unidad }} ">
                    </td>
                    <td>
                        <input type="float" class="form-control" readonly value="  {{ $comprasDetalle->cantidad }} ">
                    </td>
                    <td>
                        <div class="input-group">
                             <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Bs.</span>
                            </div>
                        <input type="float" class="form-control" readonly value="  {{ $comprasDetalle->precio }} ">
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Bs.</span>
                            </div>
                          <input type="float" class="form-control" readonly value="  {{ $comprasDetalle->sub_total }} ">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

