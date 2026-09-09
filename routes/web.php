<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    // Si no tienes una vista de login, puedes retornar un mensaje simple
    return response('Arbol creado', 200);
})->name('login');