<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;

class RegisterStep1Controller extends Controller
{
    public function store(RegisterStep1Request $request)
    {
        return redirect('/register/step2');
    }
    
}