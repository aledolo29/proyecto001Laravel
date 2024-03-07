<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use App\Mail\SeguridadMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $compruebaEmail = User::where('email', $request->email)->first();
        if ($compruebaEmail) {
            $email = $request->email;
            return redirect()->route('email.seguridad', compact('email'));
        } else {
            $usuario = new User();
            $usuario->name = $request["usuario"];
            $usuario->password = $request["password"];
            $usuario->email = $request["email"];
            $usuario->save();
            Session::flash('mensaje', 'Compruebe que le ha llegado un email de bienvenida.');
            $email = $usuario->email;
            return redirect()->route('contactanos', compact('email'));
        }
    }

    public function comprobarUser(Request $request)
    {
        $nombre = $request["usuario"];
        $password = $request["password"];
        $usuario = User::where('name', $nombre)->first();
        if ($usuario && Hash::check($password, $usuario->password)) {
            session(['usuario' => $nombre]);
            session(['email' => $usuario->email]);
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
    public function enviarEmailSeguridad($email)
    {
        $usuario = User::select('name')->where('email', $email)->first();
        $data = ['nombreUsuario' => $usuario->name];
        var_dump($data);
        $correo = new SeguridadMailable($data);
        Mail::to($email)->send($correo);
        return back()->withErrors('Error en el registro, ya existe un usuario con ese correo');
    }
}
