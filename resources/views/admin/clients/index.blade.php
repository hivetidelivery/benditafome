@extends('app')

@section('content')

    <div class="container">
        <a class="btn btn-primary btn-panel" href="{{ Route('admin.clients.create') }}">Novo cliente</a>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Clientes</h1>
            </div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id  }}</td>
                            <td>{{ $client->user->name  }}</td>
                            <td>{{ $client->phone  }}</td>
                            <td>{{ $client->city  }}</td>
                            <td>{{ $client->state  }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.clients.edit.id', ['id' => $client->id]) }}">Editar</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('admin.clients.destroy.id', ['id' => $client->id]) }}">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-footer">
                {!! $clients->render() !!}
            </div>
        </div>
    </div>

@endsection