@extends('layouts.plantilla')
@section('title', 'Registro')
@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 position-relative">
        <div class="w-100 h-100 bg-black position-absolute opacity-75"></div>
        <div class="bg-white p-4 z-1 rounded-5" style="width: 500px; height: 550px;">
            <h2 class="text-center fw-bold fs-1">Registro</h2>
            <picture class="d-flex justify-content-center">
                <img src="{{ asset('images/Captain-America-Logo-1-removebg-preview.png') }}" class="w-50" alt="Logo">
            </picture>
            <form method="post" action="{{ route('usuario.registro.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="usuario" class="form-label fw-bold">Usuario</label>
                    <input type="usuario" class="form-control border-dark-subtle" id="usuario" name="usuario"
                        aria-describedby="usuario">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control border-dark-subtle" id="email" name="email"
                        aria-describedby="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label fw-bold">Contraseña</label>
                    <input type="password" class="form-control border-dark-subtle" name="password"
                        id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-danger">Registrarse</button>
                <a href="{{ route('inicioSesion') }}"
                    class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fw-bold">/Volver</a>
            </form>
        </div>
    </div>
@endsection
