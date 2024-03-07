@extends('layouts.plantilla')
@section('title', 'Editar Personaje')

@section('content')
    <div class="container-fluid d-flex align-items-center vh-100 justify-content-center position-relative">
        <div class="w-100 h-100 bg-black position-absolute opacity-75"></div>
        <div class="bg-white p-4 z-1 rounded-5 d-flex flex-column justify-content-center" style="width: 800px;">
            <h2 class="text-center fw-bold fs-1">Editar personaje</h2>
            <form method="post" action="{{ route('personaje.update', $personaje->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control border-dark-subtle" id="nombre" name="nombre"
                        aria-describedby="usuario" value="{{ $personaje->nombre }}">
                </div>
                <div class="mb-3">
                    <label for="afiliacion" class="form-label fw-bold">Afiliación</label>
                    <input type="text" class="form-control border-dark-subtle" id="afiliacion" name="afiliacion"
                        value="{{ $personaje->afilicion }}">
                </div>
                <div class="mb-3">
                    <label for="historia" class="form-label fw-bold">Historia</label>
                    <input type="text" class="form-control border-dark-subtle" id="historia" name="historia"
                        value="{{ $personaje->historia }}">
                </div>
                <div class="mb-3">
                    <label for="apariencia" class="form-label fw-bold">Apariencia</label>
                    <input type="text" class="form-control border-dark-subtle" id="apariencia" name="apariencia"
                        value="{{ $personaje->apariencia }}">
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label fw-bold">Rol</label>
                    <select name="rol" id="rol" class="form-select border-dark-subtle">
                        <option value="Anónimo" @if ($personaje->rol == 'Anónimo') selected @endif>Anónimo</option>
                        <option value="Heroe" @if ($personaje->rol == 'Heroe') selected @endif>Heroe</option>
                        <option value="Villano" @if ($personaje->rol == 'Villano') selected @endif>Villano</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="poder" class="form-label fw-bold">Poderes</label>
                    @if ($poderes)
                        <input type="text" class="form-control border-dark-subtle" id="poder" name="poder"
                            value="{{ $poderes->poder }}">
                    @else
                        <input type="text" class="form-control border-dark-subtle"
                            placeholder="Añade los poderes que tiene este personaje" name="poder" id="poder">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="enemigos" class="form-label fw-bold">Enemigos: </label>
                    @foreach ($enemigos as $enemigo)
                    <div class="form-check d-inline-block">
                        <input class="form-check-input border-dark-subtle mx-1" type="checkbox"
                        name="enemigos_seleccionados[]" value="{{ $enemigo->id }}" id="opcion{{ $enemigo->id }}"
                        {{ $enemigosChecked->contains('id_personaje', $enemigo->id) || $enemigosChecked->contains('id_enemigo', $enemigo->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="opcion{{ $enemigo->id }}">
                            {{ $enemigo->nombre }}
                        </label>
                    </div>
                    @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-danger" value="Guardar">
            </form>
            <div class="w-auto">
                <a href="{{ route('pagina.index') }}"
                    class="mt-2 link-dark  fs-5 fw-bold link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Volver</a>
            </div>
        </div>
    </div>
@endsection
