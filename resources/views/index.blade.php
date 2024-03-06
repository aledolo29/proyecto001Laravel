@extends('layouts.plantilla')
@section('title', 'Inicio')
@section('content')
    <div class="container-fluid mt-4">
        <h1 class="text-white">{{ session('usuario') }}</h1>
        <h1 class="fw-bold text-white text-center mb-4">PERSONAJES</h1>
        @if (Session::has('mensaje'))
            <div id="mensaje" class="alert alert-success fs-5 fw-bold" role="alert">
                {{ Session::get('mensaje') }}
            </div>

            <script>
                // Ocultar el mensaje después de 5 segundos
                setTimeout(function() {
                    document.getElementById('mensaje').style.display = 'none';
                }, 5000);
            </script>
        @endif
        <table class="table fs-5 table-striped table-dark">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nombre</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Afiliación</th>
                    <th scope="col">Historia</th>
                    <th scope="col">Apariencia</th>
                    <th scope="col">Imagen</th>
                    <form action="{{ route('show.formulario') }}" method="get">
                        <th scope="col" colspan="3" class="text-end"><input type="submit"
                                class="btn btn-outline-light" value="Nuevo Personaje"></th>
                    </form>
                </tr>
            </thead>
            <tbody>
                @foreach ($personajes as $personaje)
                    <tr class="text-center">
                        <td>{{ $personaje->nombre }}</td>
                        <td>{{ $personaje->rol }}</td>
                        <td>{{ $personaje->afilicion }}</td>
                        <td>{{ $personaje->historia }}</td>
                        <td>{{ $personaje->apariencia }}</td>
                        <td><img src="{{ asset($personaje->imagen) }}" alt="imagen" class="img-fluid"></td>
                        <td><a href="{{ route('personaje.mostrar', $personaje->id) }}"
                                class="btn btn-success  w-100">Ver</a></td>
                        <td><a href="{{ route('personaje.editar', $personaje->id) }}"
                                class="btn btn-primary w-100">Editar</a></td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#confirmarEliminar{{ $personaje->id }}"
                                class="btn btn-danger
                                w-100">Borrar</button>
                            <div class="modal fade text-black " id="confirmarEliminar{{ $personaje->id }}" tabindex="-1"
                                aria-labelledby="confirmarEliminarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmarEliminarLabel">Confirmar Eliminación
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar este personaje?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <!-- Enlace o formulario para realizar la eliminación -->
                                            <form action="{{ route('personaje.eliminar', $personaje->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
