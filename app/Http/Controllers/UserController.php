<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Verifica que el usuario autenticado es un administrador
        if (auth()->user()->role !== 'admin') {
            return redirect('/home')->with('error', 'No tienes permisos de administrador.');
        }

        // Obtiene todos los usuarios de la base de datos
        $users = User::all();

        // Retorna la vista con los usuarios
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:user,admin',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Rol actualizado correctamente.');
    }
}
