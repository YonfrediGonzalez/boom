@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tarea</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Fecha de Vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Tarea</button>
    </form>
</div>
@endsection
