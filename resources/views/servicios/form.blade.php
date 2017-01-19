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
            {{ Form::label('address', 'Domicilio', ['class' => 'label']) }}
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
            {{ Form::label('date_start', 'Fecha de inicio', ['class' => 'label']) }}
            {{ Form::input('text', 'date_start', null, ['class' => 'input datepicker', 'id' => 'date_start']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-3 -->
    <div class="col-3">
        <div class="form-group">
            {{ Form::label('date_end', 'Fecha de devolución', ['class' => 'label']) }}
            {{ Form::input('text', 'date_end', null, ['class' => 'input datepicker', 'id' => 'date_end']) }}
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
                    <th>Folio</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>P. Unit.</th>
                    <th>Total</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @unless ($service->service_details->isEmpty())
                    @php
                        $service_details = $service->service_details()
                            ->selectRaw('quantity, price, total, equipment_id')
                            ->groupBy(['quantity', 'price', 'total', 'equipment_id'])->get();
                    @endphp
                    @foreach ($service_details as $service_detail)
                        @php
                            $equipment = $service_detail->equipment;
                        @endphp
                        <tr>
                            <td>{{ $equipment->folio }}</td>
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
                                {{ Form::input('number', 'equipments['.$equipment->id.'][quantity]', $service_detail->quantity, ['class' => 'input qty', 'min' => '1']) }}
                            </td>
                            <td>
                                {{ Form::input('number', 'equipments['.$equipment->id.'][price]', $service_detail->price, ['class' => 'input custom-price', 'min' => 1, 'step' => '0.01']) }}
                            </td>
                            <td>
                                {{ Form::hidden('equipments['.$equipment->id.'][total]', $service_detail->total) }}
                                <span class="equipment-price-total price">${{ $service_detail->total }}</span>
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
            <tfoot>
                <tr class="total">
                    <td colspan="4" class="tr"><b>Total</b></td>
                    <td colspan="2"><span id="grand_total" class="price">${{ ($service->total) ? $service->total : '0.00' }}</span></td>
                    {{ Form::hidden('total', ($service->total) ? $service->total : 0) }}
                </tr>
            </tfoot>
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
