<div class="form-group">
    {{ Form::label('photos[]', 'Fotos', ['class' => 'label']) }}
    @if (isset($equipment->pictures) && $equipment->pictures())
        @foreach ($equipment->pictures as $picture)
            <div class="picture">
                {{ Html::image(asset('storage/'.$picture->url), $picture->name, ['class' => 'img']) }}
            </div>
            <!-- /.picture -->
        @endforeach
    @endif
    {{ Form::file('photos[]', ['class' => 'file', 'multiple']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('title', 'Título', ['class' => 'label']) }}
    {{ Form::input('text', 'title', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('description', 'Descripción', ['class' => 'label']) }}
    {{ Form::textarea('description', null, ['size' => '10x3', 'class' => 'input autosizable']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('serial', 'Número de serie', ['class' => 'label']) }}
    {{ Form::input('text', 'serial', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('stock', 'Cantidad', ['class' => 'label']) }}
    {{ Form::input('text', 'stock', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('brand_id', 'Marca', ['class' => 'label']) }}
    {{ Form::select('brand_id', $brands, null, ['class' => 'select2-add', 'data-placeholder' => 'Selecciona una marca', 'data-tags' => true]) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('group_id', 'Grupo', ['class' => 'label']) }}
    {{ Form::select('group_id', $groups, null, ['class' => 'select2-add', 'data-placeholder' => 'Selecciona un grupo', 'data-tags' => true]) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('warehouse_id', 'Almacén', ['class' => 'label']) }}
    {{ Form::select('warehouse_id', $warehouses, null, ['class' => 'select2-add', 'data-placeholder' => 'Selecciona un almacén', 'data-tags' => true]) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-green']) }}
    {{ Html::link(url('equipos'), 'Cancelar', ['class' => 'btn btn-red']) }}
</div>
<!-- /.form-group -->
