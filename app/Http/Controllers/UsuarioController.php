<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{


    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre = $request["usuario"];
        $usuario->password = $request["password"];
        $usuario->email = $request["email"];
        $usuario->save();
        return redirect()->route('inicioSesion');
    }

    public function comprobarUser(Request $request)
    {
        $nombre = $request["usuario"];
        $password = $request["password"];
        $usuario = Usuario::where('nombre', $nombre)->where('password', $password)->first();
        if ($usuario) {
            session(['usuario' => $nombre]);
            return redirect()->route('pagina.index');
        } else {
            return back()->withErrors(['error' => 'Usuario o contraseña incorrectos']);
        }
    }
}
