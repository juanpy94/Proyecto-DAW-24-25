<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="bg bg-warning">
            <tr>
                <th>Fecha emisión</th>
                <th>Estado</th>
                <th>Precio Total</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr class="table-light">
                    <td>{{ date('d-m-Y', strtotime($invoice->fecha_emision)) }}</td>
                    <td>{{ $invoice->estado }}</td>
                    <td>{{ $invoice->total_factura }}€</td>
                    <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->categoria->nombre }}</td>
                    <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->marca }}</td>
                    <td>{{ $invoice->detalleReparacion->first()->reparacion->vehiculoMaquina->modelo }} </td>
                    <td>{{ $invoice->detalleReparacion->first()->reparacion->VehiculoMaquina->matricula ?: '-' }}</td>
                    <td>
                        <a href="{{ route('view_invoice_PDF', $invoice->id) }}" class="btn btn-warning btn-sm" target="_blank">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
