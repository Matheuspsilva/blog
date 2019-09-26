<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    public function index(){
        $helloWorld = 'Hello World';
        // view('nome_pasta.view','array associativo')
        return view('hello_world.index', compact('helloWorld'));
    }
}
