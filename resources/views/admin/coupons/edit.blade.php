@extends('app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h3>Editanto categoria {{ $category->name }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('errors._check')

                {!! Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}

                @include('admin.categories._form')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group pull-right">
                            {!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection