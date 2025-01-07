<?php

// NÃO ESQUECER que a tabela users tem que ter uma coluna deleted_at e que o modelo User usa o trait SoftDeletes!!!!!

namespace App\Http\Controllers;

use App\Models\User; // Modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe uma lista de usuários.
     */
    public function index()
    {
        // Busca todos os usuários, incluindo os deletados logicamente, caso necessário.
        $users = User::withTrashed()->get(); 
        return view('users.index', compact('users')); // Retorna a view com os dados dos usuários.
    }

    /**
     * Exibe o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('users.create'); // Mostra o formulário para criação de usuário.
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            // Adicione outras regras de validação, se necessário.
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            // Adicione outros campos, se necessário.
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function show(string $id)
    {
        $user = User::withTrashed()->findOrFail($id); // Inclui usuários deletados logicamente.
        return view('users.show', compact('user'));
    }

    /**
     * Exibe o formulário para editar um usuário.
     */
    public function edit(string $id)
    {
        $user = User::withTrashed()->findOrFail($id); // Inclui usuários deletados logicamente.
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza os dados de um usuário específico.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            // Adicione outras regras de validação, se necessário.
        ]);

        $user = User::withTrashed()->findOrFail($id); // Inclui usuários deletados logicamente.
        $user->update($request->all()); 

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Marca um usuário como deletado logicamente.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete (não remove do banco).

        return redirect()->route('users.index')->with('success', 'Usuário marcado como deletado.');
    }

    /**
     * Restaura um usuário que foi deletado logicamente.
     */
    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id); // Busca apenas usuários deletados logicamente.
        $user->restore(); // Restaura o usuário.

        return redirect()->route('users.index')->with('success', 'Usuário restaurado com sucesso.');
    }

    /**
     * Exclui definitivamente um usuário do banco de dados.
     */
    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id); // Busca apenas usuários deletados logicamente.
        $user->forceDelete(); // Exclui permanentemente.

        return redirect()->route('users.index')->with('success', 'Usuário excluído definitivamente.');
    }
}
