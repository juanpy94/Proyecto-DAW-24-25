<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="bg bg-warning">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Año</th>
                <th>Categoria</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($vehiclesMachinerys as $vehicle)
            <tr class="table-light">
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->marca }}</td>
                <td>{{ $vehicle->modelo }}</td>
                <td>{{ $vehicle->matricula ?: '-' }}</td>
                <td>{{ $vehicle->ano }}</td>
                <td>{{ $vehicle->categoria->nombre }}</td>
                <td>{{ $vehicle->usuario->usuario }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('adm_edit_vehicle', $vehicle->id) }}" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <form action="{{ route('adm_delete_vehicle', $vehicle->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este vehiculo/maquinaria?');">
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