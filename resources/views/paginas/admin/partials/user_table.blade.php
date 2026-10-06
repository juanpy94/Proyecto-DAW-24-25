<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="bg bg-warning">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Telófono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="table-light">
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->direccion }}</td>
                <td>{{ $user->ciudad }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->usuario }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->rol }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('edit_user', $user->id) }}" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <form action="{{ route('delete_user_adm', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este usuario?');">
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