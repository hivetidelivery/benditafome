@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h3>Novo cupom</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('errors._check')

                {!! Form::open(['route' => 'admin.coupons.store']) !!}

                @include('admin.coupons._form')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group pull-right">
                            {!! Form::submit('Criar cupom', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection