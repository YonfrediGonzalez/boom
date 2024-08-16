<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

  
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Task $task)
    {
        //
    }
   
    public function create(User $user)
    {
        //
    }

    public function update(User $user, Task $task)
    {
        //
    }

    public function delete(User $user, Task $task)
    {
        // Permitir la eliminación si el usuario es el dueño de la tarea o si es un administrador
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    public function restore(User $user, Task $task)
    {
        //
    }

  
    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
