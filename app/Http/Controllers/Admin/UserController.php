<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
/*         $users = User::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.users.index', compact('users')); */

        return view('admin.users.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
            'password' => 'required|string|min:6',
            'status' => 'required',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
            'phone' => $request->input('phone'),
            'birth_date' => $request->input('birth_date'),
            'document' => $request->input('document'),
        ]);

        $user->assignRole($request->input('role'));

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario creado correctamente.',
        ]);

        return redirect()->route('admin.users.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'document' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string',
            'birth_date' => 'sometimes|date',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update($request->all());

        $user->syncRoles($request->role);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario actualizado correctamente.',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->orders->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar el usuario porque tiene ordenes asociadas.',
            ]);
            return redirect()->route('admin.users.edit', $user);
        }

        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario eliminado correctamente.',
        ]);


        return redirect()->route('admin.users.index');
    }


    public function generatePassword(User $user)
    {

        $defaultPassword = '12345678';

        $user->update(['password' => Hash::make($defaultPassword)]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Contraseña reestablecida!',
            'text' => 'La nueva contraseña para el Usuario es: 12345678',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }
}
