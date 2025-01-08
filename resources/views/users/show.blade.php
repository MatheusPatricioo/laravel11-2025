{{-- resources/views/users/show.blade.php --}}
{{-- Finalidade: Mostrar os detalhes de um único usuário --}}

@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalhes do Usuário</h1>

        <div class="card">
            <div class="card-header">
                Informações do Usuário
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Status:</strong> 
                    @if($user->trashed())
                        <span class="text-danger">Deletado</span>
                    @else
                        <span class="text-success">Ativo</span>
                    @endif
                </p>
                <p><strong>Criado em:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Atualizado em:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>

            @if($user->trashed())
                <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning">Restaurar Usuário</button>
                </form>
            @else
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar Usuário</button>
                </form>
            @endif
        </div>
    </div>
@endsection
