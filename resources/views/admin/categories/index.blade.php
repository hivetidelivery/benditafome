@extends('app')

@section('content')

    <div class="container">
        <a class="btn btn-primary btn-panel" href="{{ Route('admin.categories.create') }}">Nova categoria</a>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Categorias</h1>
            </div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id  }}</td>
                            <td>{{ $category->name  }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.categories.edit.id', ['id' => $category->id]) }}">Editar</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('admin.categories.destroy.id', ['id' => $category->id]) }}">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-footer">
                {!! $categories->render() !!}
            </div>
        </div>
    </div>

@endsection