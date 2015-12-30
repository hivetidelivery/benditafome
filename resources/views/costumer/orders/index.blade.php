@extends('app')

@section('content')

    <div class="container">
        <div class="col-lg-12 col-md-8 col-sm-12">
            <div class="row">
                <h3 class="visible-lg-inline">Meus pedidos</h3>
                <a href="{{ route('costumer.order.create') }}" class="btn btn-success btn-sm visible-lg-inline pull-right">Novo pedido</a>
            </div>

            <br />

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <label class="panel-title text-info">Pedidos</label>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="alert alert-{{ $row_class[$order->status] }}">
                                        <th>{{ $order->id }}</th>
                                        <th>{{ $order->total }}</th>
                                        <th>{{ $list_status[$order->status] }}</th>
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
        </div>
    </div>

@endsection