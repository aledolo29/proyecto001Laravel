@extends('layouts.plantilla')
@section('title', 'Mostrar Personaje')
@section('content')

    <div class="container d-flex flex-column justify-content-center vh-100">
        <section class="py-3 row bg-light">
            <div class="col">
                <img src="{{ asset($personaje->imagen) }}" alt="imagen" class="img-fluid img_heroe">
            </div>

            <div class="col fs-5">
                <p><span class="fw-bold">Nombre: </span>{{ $personaje->nombre }}</p>
                <p><span class="fw-bold">Rol: </span>{{ $personaje->rol }}</p>
                <p><span class="fw-bold">Afiliación: </span>{{ $personaje->afilicion }}</p>
                <p><span class="fw-bold">Historia: </span>{{ $personaje->historia }}</p>
                <p><span class="fw-bold">Apariencia: </span>{{ $personaje->apariencia }}</p>
                @if ($poderes)
                    <p><span class="fw-bold">Poderes: </span>{{ $poderes->poder }}</p>
                @else
                    <p class="fw-bold">Poderes:</p>
                @endif
                @if ($enemigo)
                    <div><span class="fw-bold">Enemigos: </span>
                        @foreach ($enemigo as $e)
                            <p class="d-inline-block">{{ $e->nombre }}@if (!$loop->last)
                                    ,
                                @endif
                            </p>
                        @endforeach
                    </div>
                @else
                    <p class="fw-bold">Enemigos: </p>
                @endif
            </div>
        </section>
        <div class="w-auto">
            <a href="{{ route('pagina.index') }}"
                class="link-light fs-3 fw-bold link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Volver</a>
        </div>
    </div>
@endsection
