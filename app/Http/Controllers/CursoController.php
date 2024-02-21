<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        return "Bienvenido a la página cursos";
    }

    public function create()
    {
        return "En esta página puedes crear un curso";
    }

    public function show($curso)
    {
        return "Bienvenido al curso $curso";
    }
}
