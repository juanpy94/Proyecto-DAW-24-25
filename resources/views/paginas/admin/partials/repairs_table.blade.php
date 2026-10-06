<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="bg bg-warning">
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>Fecha Entrada</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Descripcion</th>
                <th>Usuario</th>
                <th>Vehiculo/Maquinaria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($repairs as $repair)
            <tr class="table-light">
                <td>{{ $repair->id }}</td>
                <td>{{ $repair->estado }}</td>
                <td>{{ date('d-m-Y', strtotime($repair->fecha_entrada)) }}</td>
                <td>{{ $repair->fecha_inicio ? date('d-m-Y', strtotime($repair->fecha_inicio)) : '-' }}</td>
                <td>{{ $repair->fecha_fin ? date('d-m-Y', strtotime($repair->fecha_fin)) : '-' }}</td>
                <td style="max-width: 300px;">{{ $repair->descripcion }}</td>
                <td>{{ $repair->VehiculoMaquina->usuario->usuario }}</td>
                <td>{{ $repair->VehiculoMaquina->marca }} {{ $repair->VehiculoMaquina->modelo }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('adm_edit_vehicle', $repair->id) }}" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <form action="{{ route('adm_delete_vehicle', $repair->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta reparación?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ms-3">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>