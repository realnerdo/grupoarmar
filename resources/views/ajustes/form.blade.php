<div class="form-group">
    {{ Form::label('sidebar_logo', 'Logotipo', ['class' => 'label']) }}
    @if (isset($setting->sidebar_logo->url))
        <div class="picture">
            {{ Html::image(asset('storage/'.$setting->sidebar_logo->url), $setting->title, ['class' => 'img']) }}
        </div>
        <!-- /.picture -->
    @endif
    {{ Form::file('sidebar_logo', ['class' => 'file']) }}
</div>
<!-- /.form-group -->
<div class="form-group">
    {{ Form::label('service_logo', 'Logotipo', ['class' => 'label']) }}
    @if (isset($setting->service_logo->url))
        <div class="picture">
            {{ Html::image(asset('storage/'.$setting->service_logo->url), $setting->title, ['class' => 'img']) }}
        </div>
        <!-- /.picture -->
    @endif
    {{ Form::file('service_logo', ['class' => 'file']) }}
</div>
<!-- /.form-group -->
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
