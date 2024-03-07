<?php

namespace App\Http\Controllers;

use App\Models\Enemigo;
use App\Models\Personaje;
use App\Models\Poder;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\alert;

class PersonajeController extends Controller
{


    public function index()
    {
        $personajes = Personaje::paginate(5);
        return view('index', compact('personajes'));
    }

    public function formulario()
    {
        return view('formPersonajes');
    }

    public function guardarPersonaje(Request $request)
    {
        $faker = Faker::create();
        $personaje = new Personaje();
        $personaje->nombre = $request->filled('nombre') ? $request->nombre : $faker->name();
        $personaje->afilicion = $request->filled("afiliacion") ? $request->afilicion : 'Ninguna';
        $personaje->historia = $request->filled('historia') ? $request->historia : $faker->sentence();
        $personaje->apariencia = $request->filled('apariencia') ? $request->apariencia : $faker->sentence();
        $imagen = $request->file('imagen');
        if ($imagen) {
            $carpetaDestino = 'images/';
            $filename = time() . '-' . $imagen->getClientOriginalName();
            $imagen->move($carpetaDestino, $filename);
            $personaje->imagen = $carpetaDestino . $filename;
        }
        $personaje->rol = $request->filled("rol") ? $request->rol : 'Anónimo';
        $personaje->save();

        Session::flash('mensaje', '' . $personaje->nombre . ' se ha añadido correctamente.');

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
        $faker = Faker::create();

        $personaje = Personaje::find($id);
        $personaje->nombre = $request->filled('nombre') ? $request->nombre : $faker->name();
        $personaje->afilicion = $request->filled("afiliacion") ? $request->afiliacion : 'Ninguna';
        $personaje->historia = $request->filled('historia') ? $request->historia : $faker->sentence();
        $personaje->apariencia = $request->filled('apariencia') ? $request->apariencia : $faker->sentence();
        $personaje->rol = $request->rol;

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
        Enemigo::where('id_personaje', $id)->orWhere('id_enemigo', $id)->delete();
        $personaje = Personaje::find($id);
        $personaje->delete();
        Session::flash('mensaje', '' . $personaje->nombre . ' se ha borrado correctamente.');
        return redirect()->route('pagina.index');
    }
}
