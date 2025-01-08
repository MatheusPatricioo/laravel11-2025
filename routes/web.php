<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Este arquivo é onde você pode registrar rotas web para sua aplicação.
| Estas rotas são carregadas pelo RouteServiceProvider dentro de um grupo
| que contém o middleware "web".
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Página inicial do painel de controle
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Página de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Página de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Página de contato
Route::get('/contato', function () {
    return view('contact');
})->name('contact');

// Página de sobre
Route::get('/sobre', function () {
    return view('about');
})->name('about');

// Inclua as rotas de gerenciamento de usuários
require __DIR__.'/users.php';
