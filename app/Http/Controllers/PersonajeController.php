<?php

namespace App\Http\Controllers;

use App\Models\Enemigo;
use App\Models\Personaje;
use App\Models\Poder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\alert;

class PersonajeController extends Controller
{

    public function index()
    {
        $personajes = Personaje::all();
        return view('index', compact('personajes'));
    }

    public function formulario()
    {
        return view('formPersonajes');
    }

    public function guardarPersonaje(Request $request)
    {
        $personaje = new Personaje();
        $personaje->nombre = $request["nombre"];
        $personaje->afilicion = $request["afiliacion"];
        $personaje->historia = $request["historia"];
        $personaje->apariencia = $request["apariencia"];
        $imagen = $request->file('imagen');
        $carpetaDestino = 'images/';
        $filename = time() . '-' . $imagen->getClientOriginalName();
        $uploadSucces = $imagen->move($carpetaDestino, $filename);
        $personaje->imagen = $carpetaDestino . $filename;
        $personaje->rol = $request["rol"];
        $personaje->save();

        return redirect()->route('pagina.index');
    }

    public function showPersonaje($id)
    {
        $personaje = Personaje::find($id);
        $poderes = Poder::where('id_personaje', $id)->first();
        $id_enemigo = Enemigo::select('id_enemigo')->where('id_personaje', $id)->get();
        $enemigo = [];
        foreach ($id_enemigo as $e) {
            $enemigo[] = Personaje::select('nombre')->where('id', $e->id_enemigo)->first();
        }
        return view('mostrarPersonaje', compact('personaje', 'poderes', 'enemigo'));
    }
    public function editarPersonaje($id)
    {
        $personaje = Personaje::find($id);
        $poderes = Poder::where('id_personaje', $id)->first();
        if ($personaje->rol == 'Heroe') {
            $enemigos = Personaje::where('rol', 'Villano')->get();
        } else {
            $enemigos = Personaje::where('rol', 'Heroe')->get();
        }
        $enemigosChecked = Enemigo::where('id_enemigo', $id)->orWhere('id_personaje', $id)->get();

        return view('editarPersonaje', compact('personaje', 'poderes', 'enemigos', 'enemigosChecked'));
    }

    public function updatePersonaje(Request $request, $id)
    {
        $personaje = Personaje::find($id);
        $personaje->nombre = $request["nombre"];
        $personaje->historia = $request["historia"];
        $personaje->afilicion = $request["afiliacion"];
        $personaje->apariencia = $request["apariencia"];

        $poderes = Poder::where('id_personaje', $id)->first();
        if ($poderes) {
            $poderes->id_personaje = $id;
            $poderes->poder = $request["poder"];
        } else {
            $poderes = new Poder();
            $poderes->id_personaje = $id;
            $poderes->poder = $request["poder"];
        }

        $enemigos = $request["enemigos_seleccionados"];
        Enemigo::where('id_personaje', $id)->orWhere('id_enemigo', $id)->delete();
        if (!empty($enemigos)) {
            foreach ($enemigos as $e) {
                if ($e) {
                    $enemy = new Enemigo();
                    $enemy_inverse = new Enemigo();
                    $enemy->id_personaje = $id;
                    $enemy->id_enemigo = $e;
                    $enemy_inverse->id_personaje = $e;
                    $enemy_inverse->id_enemigo = $id;
                    $enemy->save();
                    $enemy_inverse->save();
                }
            }
        }
        $poderes->save();
        $personaje->save();
        Session::flash('mensaje', '' . $personaje->nombre . ' se ha actualizado correctamente.');
        return redirect()->route('pagina.index');
    }

    public function eliminarPersonaje($id)
    {
        $personaje = Personaje::find($id);
        $personaje->delete();
        Session::flash('mensaje', '' . $personaje->nombre . ' se ha borrado correctamente.');
        return redirect()->route('pagina.index');
    }
}
