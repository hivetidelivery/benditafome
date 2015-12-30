@extends('app')

@section('content')

    <div class="container">
        <a class="btn btn-primary btn-panel" href="{{ Route('admin.coupons.create') }}">Novo Cupom</a>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Cupons</h1>
            </div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id  }}</td>
                            <td>{{ $coupon->code  }}</td>
                            <td>{{ $coupon->value  }}</td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="{{ route('admin.coupons.destroy.id', ['id' => $coupon->id]) }}">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel-footer">
                {!! $coupons->render() !!}
            </div>
        </div>
    </div>

@endsection