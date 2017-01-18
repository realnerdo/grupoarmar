<div class="form-group">
    {{ Form::label('title', 'Título', ['class' => 'label']) }}
    {{ Form::input('text', 'title', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('address', 'Domicilio', ['class' => 'label']) }}
    {{ Form::input('text', 'address', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-green']) }}
    {{ Html::link(url('almacenes'), 'Cancelar', ['class' => 'btn btn-red']) }}
</div>
<!-- /.form-group -->
