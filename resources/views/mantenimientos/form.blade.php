<div class="form-group">
    {{ Form::label('equipment_detail_id', 'Equipo', ['class' => 'label']) }}
    {{ Form::select('equipment_detail_id', $equipment_details, null, ['class' => 'select2', 'data-placeholder' => 'Selecciona un equipo']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('reason', 'Causa/Desperfecto', ['class' => 'label']) }}
    {{ Form::input('text', 'reason', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('description', 'Descripción de mantenimiento', ['class' => 'label']) }}
    {{ Form::textarea('description', null, ['size' => '30x5', 'class' => 'input autosizable']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('perform_date', 'Fecha de realización', ['class' => 'label']) }}
    {{ Form::input('text', 'perform_date', null, ['class' => 'input datepicker']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('supplier_id', 'Proveedor', ['class' => 'label']) }}
    {{ Form::select('supplier_id', $suppliers, null, ['class' => 'select2-add', 'data-placeholder' => 'Selecciona un proveedor', 'data-tags' => true]) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('responsible', 'Encargado de mantenimiento', ['class' => 'label']) }}
    {{ Form::input('text', 'responsible', null, ['class' => 'input']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-green']) }}
    {{ Html::link(url('mantenimientos'), 'Cancelar', ['class' => 'btn btn-red']) }}
</div>
<!-- /.form-group -->
