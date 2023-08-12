<?php

namespace App\Http\Controllers;

use App\Models\UsersAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    //no se si sirva el middleware aqui o en el web.php, pero dejesmolo aqui, no entiendo los middleware aun
    public function __construct()
    {
        // Aplica el middleware 'admin' a todas las rutas del controlador
        $this->middleware('admin');
    }
//aun no creo un formulario de creador de admin
    public function create_admin(){
        UsersAdmin::create([
            'username' => 'Juan',
            'password' => bcrypt('johan07141234'),
            'color' => '#9370DB',
        ]);

        // Optionally, you can add a success message
        session()->flash('success', '¡Admin creado exitosamente!');

        // Redirect to a specific route or stay on the same page
        return redirect()->back();
    }
    //vista de login
    public function login_admin_view()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('inicio_admin'); // Cambiar 'inicio_admin' por la ruta adecuada para el panel de administración
        }

        return view('auth.login_admin');
    }
    //funcion de login
    public function login_admin(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            // Autenticación exitosa para el guard 'admin'
            $user = Auth::guard('admin')->user();

        // Establecer la sesión del administrador manualmente
        auth()->login($user);
            return redirect()->route('index_admin')->with('success', 'Hola admin, te quiero <3');
        } else {
            // Autenticación fallida
            return redirect()->back()->withErrors(['login' => 'Credenciales incorrectas.'])->withInput();
        }
    }
    //logout manito lea
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('inicio');
    }
    //el welcome de admin
    public function index_admin () {
        return view('welcome_admin');
    }

}


