<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Category', 'Categoria:') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Description', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Price', 'Preço:') !!}
            {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>

    </div>
</div>