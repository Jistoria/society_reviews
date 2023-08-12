<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\EnviarCorreo;
use App\Models\Grade;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function welcome (){
        $reviews = Review::get();
        $tags = Tag::get();
        $grades = Grade::get();
        return view('welcome', compact('reviews', 'tags', 'grades'));
    }
       //Funcion de busqueda
    public function search(Request $request){
        //se declaran las variables de busqueda
        $title =$request->search;
        $tags = $request->tags;
        $grade = $request->grade;
        //generamos una consulta con el titulo, si titulo llega vacio solo hace un get y no search
        $reviews = $title ? Review::search($title)->get() : Review::get();
        //funcion de filtro de tag
        if ($tags) {
            $reviews = $reviews->filter(function ($review) use ($tags) {
                foreach ($tags as $tagId) {
                    if (!$review->tags->contains('id_tag', $tagId)) {
                        return false;
                    }
                }
                return true;
            });
        }
        //funcion de filtro de calificacion
        if ($grade) {
            $reviews = $reviews->filter(function ($review) use ($grade) {
                return trim($review->grade_master()) === trim($grade);
            });
        }
        //tengo que generar de nuevo los valores para la vista
        $tags = Tag::get();
        $grades = Grade::get();
        return view('welcome', compact('reviews', 'tags', 'grades'));
    }
    public function index_register(){
        if(!Auth::user()){
            return view('auth.register');
        }
        return redirect('/');
    }
    public function register(RegisterRequest $request){
        //ya veo q hago
        // Create a new User instance
        $user = User::create($request->validated());
        if($user){
            Auth::login($user);
            event(new Registered($user));
        }
        // Redirect the user after successful registration
        return redirect()->route('inicio')->with('success', '¡Registro exitoso! Debes verificar tu email.');
    }
    public function index_login(){
        if(Auth::user()){
            return redirect('/');
        }
        return view('auth.login');
    }
    public function login(LoginRequest $request){
        $credentials = $request -> getCredentials();
            if (Auth::attempt($credentials)) {
                // Authentication successful
                // Optionally, you can log in the user automatically
                auth()->login(Auth::user());
                // Redirect to the intended URL or the specified fallback
                return redirect('/');
            } else {
                // Authentication failed
                // Redirect back with errors
                return redirect()->back()->withErrors(['login' => 'Las credenciales son incorrectas.'])->withInput();
            }
    }
    public function logout(){
        Auth::logout();
        // Optionally, you can flash a success message before redirecting
        // session()->flash('success', '¡Has cerrado sesión correctamente!');
        session()->flash('success', '¡Has cerrado sesión correctamente!');
        return redirect()->back();
    }
    // public function enviar_correo($email){
    //     Mail::to($email)->send(new EnviarCorreo);
    // }
    public function verify(EmailVerificationRequest $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return redirect('/');
        }
        if($request->user()->markEmailAsVerified()){
            event(new Verified($request->user()));
        }
        return redirect('/');
    }
}
