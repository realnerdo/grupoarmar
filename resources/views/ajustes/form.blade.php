<div class="form-group">
    {{ Form::label('title', 'Nombre del negocio', ['class' => 'label']) }}
    {{ Form::input('text', 'title', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('owner', 'Propietario', ['class' => 'label']) }}
    {{ Form::input('text', 'owner', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('email', 'Correo electrónico', ['class' => 'label']) }}
    {{ Form::input('email', 'email', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('phone', 'Teléfono', ['class' => 'label']) }}
    {{ Form::input('text', 'phone', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('address', 'Dirección', ['class' => 'label']) }}
    {{ Form::input('text', 'address', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-green']) }}
    {{ Html::link(url('/'), 'Cancelar', ['class' => 'btn btn-red']) }}
</div>
<!-- /.form-group -->
