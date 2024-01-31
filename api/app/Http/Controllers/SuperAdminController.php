<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminController extends Controller
{
    public function createAdmin(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'color' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $new_user = $request->only('name', 'email', 'color', 'password');
        $user = new User;

        $superAdminRole = Role::where('name', 'admin')->first();

        if ($superAdminRole) {
            $user->fill($new_user);
            $user->save();

            $user->assignRole($superAdminRole);

            return response(['message' => 'Creado con éxito'], Response::HTTP_CREATED);
        } else {
            return response(['error' => 'Falló en la creación'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Manejar la excepción de validación
        $errors = $e->validator->errors()->getMessages();

        return response(['error' => 'Error de validación', 'messages' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
    } catch (\Exception $e) {
        // Manejar otras excepciones
        return response(['error' => 'Error interno del servidor'.$e], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}
