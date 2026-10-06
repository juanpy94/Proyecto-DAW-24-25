<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="bg bg-warning">
            <tr>
                <th>ID</th>
                <th>Fecha Emisión</th>
                <th>Estado</th>
                <th>Total Factura</th>
                <th>Administrativo</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr class="table-light">
                <td>{{ $invoice->id }}</td>
                <td>{{ date('d-m-Y', strtotime($invoice->fecha_emision)) }}</td>
                <td>{{ $invoice->estado }}</td>
                <td>{{ $invoice->total_factura }}€</td>
                <td>{{ $invoice->usuario->nombre }}</td>
                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->categoria->nombre }}</td>
                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->marca }}</td>
                <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->modelo }} </td>
                <td>{{ $invoice->detalleReparacion->first()->reparacion->VehiculoMaquina->matricula ?: '-' }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('adm_edit_invoice', $invoice->id) }}" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>