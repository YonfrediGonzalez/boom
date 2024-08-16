@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Mis Tareas</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar tareas..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>

        <!-- Botones de filtro para tareas -->
        <div class="mb-4 d-flex justify-content-between">
            <div>
                <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-success">Completadas</a>
                <a href="{{ route('tasks.index', ['filter' => 'incomplete']) }}" class="btn btn-warning">No Completadas</a>
                <a href="{{ route('tasks.index') }}" class="btn btn-dark">Todas</a>
            </div>
            <a href="{{ route('tasks.create') }}" class="btn btn-success">Crear Nueva Tarea</a>
        </div>

        @if ($tasks->count())
            <table id="mtable" class="table table-bordered dt-responsive table-hover display nowrap">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Fecha de Vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-center">Completar</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->due_date->format('d/m/Y') }}</td>
                            <td>
                                @if (!$task->completed)
                                    <span class="badge bg-warning">Pendiente</span>
                                @else
                                    <span class="badge bg-success">Completada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!$task->completed)
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Completar</button>
                                    </form>
                                @else
                                    <span class="text-muted">--</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form id="delete-task-{{ $task->id }}"
                                        action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $task->id }})">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                No tienes tareas pendientes.
            </div>
        @endif
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mtable').DataTable({
                paging: true,
                searching: true,
                info: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Tareas'
                }],
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página.',
                    zeroRecords: 'Lo sentimos. No se encontraron registros.',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrado de _MAX_ registros en total)',
                    search: 'Buscar:',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente',
                    }
                }
            });
        });
    </script>


    {{-- script switlaert2 --}}
    <script>
        function confirmDelete(taskId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-task-' + taskId).submit();
                }
            });
        }
    </script>


@endsection
