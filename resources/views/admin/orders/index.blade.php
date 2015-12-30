@extends('app')

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Pedidos</h1>
            </div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Itens</th>
                        <th>Entregador</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $order)
                        <tr class="alert alert-{{ $row_class[$order->status] }}">
                            <td>#{{ $order->id  }}</td>
                            <td>R${{ $order->total  }}</td>
                            <td>{{ $order->created_at  }}</td>
                            <td>
                                <ul class="list-group">
                                    @foreach($order->items as $item)
                                        <li class="list-group-item list-group-item-{{ $row_class[$order->status] }}">{{ $item->product->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($order->deliveryman)
                                    {{ $order->deliveryman->name }}
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                {{ $list_status[$order->status] }}
                            </td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('admin.orders.edit.id', ['id' => $order->id]) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-footer">
                {!! $orders->render() !!}
            </div>
        </div>
    </div>

@endsection