<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{


    public function login()
    {
        return view('login');
    }

    public function create()
    {
        return view('registro');
    }
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request["usuario"];
        $usuario->password = $request["password"];
        $usuario->email = $request["email"];
        $usuario->save();
        Session::flash('mensaje', 'Compruebe que le ha llegado un emailde bienvenida.');
        $email = $usuario->email;

        return redirect()->route('contactanos', compact('email'));
    }

    public function comprobarUser(Request $request)
    {
        $nombre = $request["usuario"];
        $password = $request["password"];
        $usuario = User::where('name', $nombre)->first();
        if ($usuario && Hash::check($password, $usuario->password)) {
            session(['usuario' => $nombre]);
            return redirect()->route('pagina.index');
        } else {
            return back()->withErrors(['error' => 'Usuario o contraseña incorrectos']);
        }
    }

    public function enviarEmail($email)
    {
        $usuario = User::select('name')->where('email', $email)->first();
        $data = ['nombreUsuario' => $usuario->name];
        $correo = new ContactanosMailable($data);
        Mail::to($email)->send($correo);
        Session::flash('mensaje', 'Usuario registrado correctamente. Compruebe que le ha llegado el email de bienvenida');
        return redirect()->route('inicioSesion');
    }
}
