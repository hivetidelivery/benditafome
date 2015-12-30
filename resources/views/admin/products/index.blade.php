@extends('app')

@section('content')

    <div class="container">
        <a class="btn btn-primary btn-panel" href="{{ Route('admin.products.create') }}">Novo produto</a>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Produtos</h1>
            </div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id  }}</td>
                            <td>{{ $product->name  }}</td>
                            <td>{{ $product->category->name  }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.products.edit.id', ['id' => $product->id]) }}">Editar</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('admin.products.destroy.id', ['id' => $product->id]) }}">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-footer">
                {!! $products->render() !!}
            </div>
        </div>
    </div>

@endsection