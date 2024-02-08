<?php

namespace App\Http\Controllers;

use App\Events\UserVerified;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getSessionDetails()
    {
        $user = auth()->user();

        if ($user) {
            // Obtener detalles del usuario, como el tipo y rol
            $userDetails = $user->getSessionDetails();

            return response()->json(['user' => $userDetails]);
        }

        return response()->json(['error' => 'Usuario no autenticado'], JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function userRegister(RegisterRequest $request)
    {
        try {
            $new_user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'color' => $request->input('color'),
                'password' => bcrypt($request->input('password')),
            ]);
            $civilRole = Role::where('name', 'Civil')->first();
            if ($civilRole) {
                $new_user->assignRole($civilRole);
                $new_user->sendEmailVerificationNotification();
                Auth::login($new_user);
                $token = $new_user->createToken('token-name')->plainTextToken;
                $cookie = cookie('cookie_token', $token, 60 * 24);
                return response()->json([
                    'success' => true,
                    'message' => 'Registrado exitosamente',
                    'user' => $new_user->getSessionDetails()
                ], Response::HTTP_CREATED)->withCookie($cookie);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return response()->json(['success' => false, 'message' => 'Error de validación', 'errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error interno del servidor. $e"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function userLogin (Request $request)
    {
        // Validación básica de datos
        $request->validate([
            'identifier' => 'required', // Nuevo campo 'identifier' que puede ser un correo electrónico o nombre de usuario
            'password' => 'required',
        ]);

        $credentials = $request->only('password');

        // Verificar si el campo 'identifier' es un correo electrónico o nombre de usuario
        $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials[$field] = $request->identifier;
        if (Auth::attempt($credentials)) {
            // Obtener el usuario autenticado
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
        // Obtener el número de notificaciones del usuario
        // Retornar una respuesta JSON con éxito y el usuario
        return response()->json(['user'=> $user->getSessionDetails()],Response::HTTP_OK)->withCookie(($cookie));
        } else {
            // La autenticación ha fallado
            return response(['success'=>false, 'message'=>'Credenciales invalidas'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout ()
    {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget('cookie_token');
        return response(['message' => 'Cerró Sesión'], Response::HTTP_OK)->withCookie($cookie);
    }



    public function verify($id, $hash)
    {
        // Buscar al usuario por ID
        $user = User::find($id);

        // Verificar si el usuario existe y si el hash es correcto
        if (!$user || sha1($user->getEmailForVerification()) !== $hash) {
            return response()->json(['success'=>false, 'message'=>'enlace no válido']);
        }

        // Verificar si el usuario ya ha sido verificado
        if ($user->hasVerifiedEmail()) {
            return response()->json(['success'=>true, 'message'=>'Este correo electrónico ya ha sido verificado previamente.']);
        }

        // Verificar el correo electrónico del usuario
        $user->markEmailAsVerified();

        // Generar un evento de verificación
        event(new UserVerified($user));

        // Redireccionar a donde desees después de la verificación
        return response()->json(['success'=>true, 'message'=>'Se ha verificado el email']);
    }
}
