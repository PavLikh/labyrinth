<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeController extends Controller
{

    public function index() {       
        return view('life');
    }
}
