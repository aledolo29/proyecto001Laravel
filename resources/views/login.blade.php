@extends('layouts.plantilla')
@section('title', 'Superhéroes')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 position-relative">
        <div class="w-100 h-100 bg-black position-absolute opacity-75"></div>
        <div class="bg-white p-4 z-1 rounded-5 d-flex flex-column justify-content-center"
            style="width: 500px; height: 600px;">
            @if (Session::has('mensaje'))
                <div id="mensaje" class="alert alert-success fs-5 fw-bold" role="alert">
                    {{ Session::get('mensaje') }}
                </div>
            @endif
            <script>
                // Ocultar el mensaje después de 5 segundos
                setTimeout(function() {
                    document.getElementById('mensaje').style.display = 'none';
                }, 5000);
            </script>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-center fw-bold fs-1">Inicio Sesión</h2>
            <picture class="d-flex justify-content-center">
                <img src="{{ asset('images/Captain-America-Logo-1-removebg-preview.png') }}" class="w-50" alt="Logo">
            </picture>
            <form method="GET" action="{{ route('usuario.comprobar') }}">
                @csrf
                <div class="mb-3">
                    <label for="usuario" class="form-label fw-bold">Usuario</label>
                    <input type="usuario" class="form-control border-dark-subtle" id="usuario" name="usuario"
                        aria-describedby="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Contraseña</label>
                    <input type="password" class="form-control border-dark-subtle" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-danger">Iniciar Sesión</button>
                <a href="{{ route('usuario.registro') }}"
                    class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fw-bold">/Registro</a>
            </form>
        </div>
    </div>
@endsection
