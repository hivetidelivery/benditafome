@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h3>Editanto cliente {{ $client->user->name }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('errors._check')

                {!! Form::model($client, ['route' => ['admin.clients.update', $client->id]]) !!}

                @include('admin.clients._form')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group pull-right">
                            {!! Form::submit('Alterar cliente', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection