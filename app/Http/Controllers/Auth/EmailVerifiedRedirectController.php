<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerifiedRedirectController extends Controller
{
    public function redirectTo(Request $request)
    {
        return redirect()->route('inicioSesion')->with('verified', true);
    }
}
