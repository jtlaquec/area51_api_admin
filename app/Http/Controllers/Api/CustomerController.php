<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\CustomerResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json(['data' => CustomerResource::collection($users)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json(['data' => new CustomerResource($user)], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'status' => 1,
            ]);

            $message = 'Cliente creado con éxito.';
            return response()->json(['data' => new CustomerResource($user), 'message' => $message], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $user->fill($request->only(['name', 'email']));

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            $message = 'Cliente actualizado con éxito.';
            return response()->json(['data' => new CustomerResource($user), 'message' => $message], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user = User::findOrFail($user->id);
            $user->status = 0;
            $user->save();

            $message = 'Cliente desactivado con éxito.';
            return response()->json(['data' => new CustomerResource($user), 'message' => $message], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Credenciales no válidas.'], 401);
        }

        // Verificamos si el cliente está activo
        if ($user->status != 1) {
            return response()->json(['success' => false, 'error' => 'El cliente fue desactivado.'], 401);
        }

        // Verificamos la contraseña
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['success' => false, 'error' => 'La contraseña no es válida.'], 401);
        }

        // Autenticación exitosa
        $message = 'Inicio de sesión exitoso.';
        return response()->json(['success' => true, 'data' => $user, 'message' => $message], 200);
    }
}
