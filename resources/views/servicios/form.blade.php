<div class="row">
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('client_id', 'Cliente', ['class' => 'label']) }}
            {!! Form::select('client_id', $clients, null, ['class' => 'select2-add', 'id' => 'client_id', 'data-placeholder' => 'Selecciona un cliente']) !!}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('company', 'Empresa', ['class' => 'label']) }}
            {{ Form::input('text', 'company', ($service->client) ? $service->client->name : null, ['class' => 'input', 'id' => 'company']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('phone', 'Teléfono', ['class' => 'label']) }}
            {{ Form::input('text', 'phone', ($service->client) ? $service->client->phone : null, ['class' => 'input', 'id' => 'phone']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('email', 'Correo electrónico', ['class' => 'label']) }}
            {{ Form::input('email', 'email', ($service->client) ? $service->client->email : null, ['class' => 'input', 'id' => 'email']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('trade_name', 'Nombre comercial', ['class' => 'label']) }}
            {{ Form::input('text', 'trade_name', ($service->client) ? $service->client->trade_name : null, ['class' => 'input', 'id' => 'trade_name']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('rfc', 'R.F.C.', ['class' => 'label']) }}
            {{ Form::input('text', 'rfc', ($service->client) ? $service->client->rfc : null, ['class' => 'input', 'id' => 'rfc']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('address', 'Dirección', ['class' => 'label']) }}
            {{ Form::input('text', 'address', ($service->client) ? $service->client->address : null, ['class' => 'input', 'id' => 'address']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('zipcode', 'Código Postal', ['class' => 'label']) }}
            {{ Form::input('text', 'zipcode', ($service->client) ? $service->client->zipcode : null, ['class' => 'input', 'id' => 'zipcode']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('event', 'Evento', ['class' => 'label']) }}
            {{ Form::input('text', 'event', null, ['class' => 'input']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('date_start', 'Fecha de entrega', ['class' => 'label']) }}
            {{ Form::input('text', 'date_start', null, ['class' => 'input datepicker']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('date_end', 'Fecha de término', ['class' => 'label']) }}
            {{ Form::input('text', 'date_end', null, ['class' => 'input datepicker']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('personal', 'Personal', ['class' => 'label']) }}
            {{ Form::checkbox('personal', 1, null, ['class' => 'checkbox']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('search', 'Buscar equipo', ['class' => 'label']) }}
            {{ Form::select('search', ['0' => 'Buscar equipo por nombre o número de serie'], null, ['class' => 'select2-equipment', 'id' => 'search_equipment']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-12">
        <table class="table services">
            <thead>
                <tr>
                    <th>Número de serie</th>
                    <th>Foto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @unless ($service->service_details->isEmpty())
                    @foreach ($service->service_details as $service_detail)
                        @php
                            $equipment = $service_detail->equipment;
                        @endphp
                        <tr>
                            <td>{{ $equipment->serial }}</td>
                            <td>
                                <div class="equipment-photo">
                                    {{ Html::image(url('storage/'.$equipment->pictures->first()->url), $equipment->title, ['class' => 'img']) }}
                                </div>
                                <!-- /.equipment-photo -->
                            </td>
                            <td>
                                <h4 class="equipment-title">{{ $equipment->title }}</h4>
                                <!-- /.equipment-title -->
                                <h5 class="equipment-brand"><b>Marca:</b> <i>{{ $equipment->brand->title }}</i></h5>
                                <!-- /.equipment-brand -->
                                <h5 class="equipment-group"><b>Grupo:</b> <i>{{ $equipment->group->title }}</i></h5>
                                <!-- /.equipment-group -->
                                <h5 class="equipment-warehouse"><b>Almacén:</b> <i>{{ $equipment->warehouse->title }}</i></h5>
                                <!-- /.equipment-warehouse -->
                                <div class="equipment-description">
                                    {{ $equipment->description }}
                                </div>
                                <!-- /.equipment-description -->
                            </td>
                            <td>
                                {{ Form::input('number', 'equipments['.$equipment->id.'][quantity]', $service_detail->quantity, ['class' => 'input qty', 'min' => '1', 'max' => ($equipment->stock > 0) ? $equipment->stock : '1']) }}
                            </td>
                            <td>
                                {{ Form::hidden('equipments['.$equipment->id.'][equipment_id]', $equipment->id) }}
                                @if ($service_detail->id)
                                    {{ Form::hidden('equipments['.$equipment->id.'][id]', $service_detail->id) }}
                                @endif
                                <button class="delete-row"><i class="typcn typcn-delete"></i> Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @endunless
            </tbody>
        </table>
        <!-- /.table -->
    </div>
    <!-- /.col-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="buttons pr">
            <button type="submit" class="btn btn-green"><i class="typcn typcn-printer"></i> Guardar</button>
        </div>
        <!-- /.tools -->
    </div>
    <!-- /.col-12 -->
</div>
<!-- /.row -->
