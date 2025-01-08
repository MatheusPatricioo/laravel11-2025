{{--  Finalidade: Mostrar a lista de todos os usuários. --}}
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>
    @if($users->count())
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    @else
        <p>Nenhum usuário encontrado.</p>
    @endif
</body>
</html>
