@extends('layouts.plantilla')
@section('title', 'Formulario personajes')

@section('content')
    <div class="container-fluid d-flex align-items-center vh-100 justify-content-center position-relative">
        <div class="w-100 h-100 bg-black position-absolute opacity-75"></div>
        <div class="bg-white p-4 z-1 rounded-5 d-flex flex-column justify-content-center" style="width: 800px;">
            <h2 class="text-center fw-bold fs-1">Añade tu personaje</h2>
            <form method="post" action="{{ route('personaje.guardar') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control border-dark-subtle" id="nombre" name="nombre"
                        aria-describedby="usuario">
                </div>
                <div class="mb-3">
                    <label for="afiliacion" class="form-label fw-bold">Afiliación</label>
                    <input type="text" class="form-control border-dark-subtle" id="afiliacion" name="afiliacion">
                </div>
                <div class="mb-3">
                    <label for="historia" class="form-label fw-bold">Historia</label>
                    <input type="text" class="form-control border-dark-subtle" id="historia" name="historia">
                </div>
                <div class="mb-3">
                    <label for="apariencia" class="form-label fw-bold">Apariencia</label>
                    <input type="text" class="form-control border-dark-subtle" id="apariencia" name="apariencia">
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label fw-bold">Rol</label>
                    <select name="rol" id="rol" class="form-select border-dark-subtle">
                        <option value="">Seleccionar</option>
                        <option value="Heroe">Héroe</option>
                        <option value="Villano">Villano</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label fw-bold">Imagen</label>
                    <input type="file" class="form-control border-dark-subtle" id="imagen" name="imagen">
                </div>
                <input type="submit" class="btn btn-danger" value="Guardar">
            </form>
        </div>
    </div>
@endsection
