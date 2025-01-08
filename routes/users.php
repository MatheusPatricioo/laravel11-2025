<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Gerenciamento de Usuários
|--------------------------------------------------------------------------
|
| Rotas que gerenciam usuários, como listar, exibir, criar, editar, deletar, restaurar.
|
*/

// Listar todos os usuários (incluindo deletados logicamente)
Route::get('admin/usuarios', [UserController::class, 'index'])->name('users.index');

// Exibir os detalhes de um usuário específico
Route::get('admin/usuarios/{user}', [UserController::class, 'show'])->name('users.show');

// Deletar logicamente um usuário
Route::delete('admin/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Restaurar um usuário deletado logicamente
Route::patch('admin/usuarios/{user}/restaurar', [UserController::class, 'restore'])->name('users.restore');
