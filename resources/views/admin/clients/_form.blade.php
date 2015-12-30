<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Email', 'Email:') !!}
            {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Phone', 'Telefone:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Address', 'Endereço:') !!}
            {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('City', 'Cidade:') !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('State', 'Estado:') !!}
            {!! Form::text('state', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('Postcode', 'Cep:') !!}
            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>