<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
 
    public function index(Request $request)
    {
        // Inicializar la consulta base
        $query = Task::query();
    
        // Filtrar por estado de tarea completada o incompleta
        if ($request->get('filter') == 'completed') {
            $query->where('completed', true);
        } elseif ($request->get('filter') == 'incomplete') {
            $query->where('completed', false);
        }
    
        // Aplicar búsqueda por título o descripción
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }
    
        // Obtener las tareas resultado de la consulta
        $tasks = $query->get();
    
        // Retornar la vista con las tareas
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }

    public function complete(Task $task)
    {
        $task->completed = true;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tarea marcada como completada.');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
