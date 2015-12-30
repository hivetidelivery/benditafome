@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Detalhes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th>Pedido</th>
                            <td>#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th>Cliente</th>
                            <td>{{ $order->client->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Data</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                           <th colspan="2" class="alert alert-success">
                               Entregar em: {{ $order->client->address }} -
                                            {{ $order->client->city }} -
                                            {{ $order->client->state }}
                           </th>
                        </tr>

                        <tr>
                            <th colspan="2" class="alert alert-warning">
                                {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}

                                    <div class="form-group">
                                        {!! Form::label('Status', 'Status:') !!}
                                        {!! Form::select('status', $list_status, null, ['class' => 'form-control']) !!}
                                    </div>
                                
                                    <div class="form-group">
                                        {!! Form::label('Entregador', 'Entregador:') !!}
                                        {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group pull-right">
                                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                                    </div>

                                {!! Form::close() !!}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>



    </div>

@endsection