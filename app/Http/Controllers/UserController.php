<?php

// NÃO ESQUECER: A tabela `users` deve ter uma coluna `deleted_at` e o modelo `User` deve usar o trait `SoftDeletes`!

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe uma lista de usuários.
     *
     * Inclui usuários deletados logicamente caso necessário.
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Exibe o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Exibe os detalhes de um usuário específico.
     *
     * O usuário é injetado automaticamente pela rota via Model Binding.
     */
    public function show($id)
{
    $user = User::withTrashed()->findOrFail($id); // Inclui usuários deletados
    return view('users.show', compact('user'));
}


    /**
     * Exibe o formulário para editar um usuário.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza os dados de um usuário específico.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Marca um usuário como deletado logicamente.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário marcado como deletado.');
    }

    /**
     * Restaura um usuário que foi deletado logicamente.
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'Usuário restaurado com sucesso.');
    }

    /**
     * Exclui definitivamente um usuário do banco de dados.
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído definitivamente.');
    }
}
