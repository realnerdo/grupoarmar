@extends('layout.base')

@section('title', 'Servicios')
@section('sectionTitle', 'Servicios')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('servicios/exportExcel') }}" class="btn btn-green add"><i class="typcn typcn-download"></i> Exportar a Excel</a>
        <a href="{{ url('servicios/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Nueva servicio</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    @unless ($services->isEmpty())
        {{-- <div class="row">
            {{ Form::open(['url' => '/', 'class' => 'form']) }}
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('date', 'Fecha:', ['class' => 'label']) }}
                        {{ Form::input('text', 'date', null, ['class' => 'input']) }}
                    </div><!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('seller', 'Vendedor:', ['class' => 'label']) }}
                        {{ Form::select('seller', ['Vendedor', 'Vendedor', 'Vendedor'], null, ['class' => 'select2']) }}
                    </div><!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('status', 'Estado:', ['class' => 'label']) }}
                        {{ Form::select('seller', ['Pendiente', 'Aceptada', 'Rechazada'], null, ['class' => 'select2']) }}
                    </div><!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('company', 'Empresa:', ['class' => 'label']) }}
                        {{ Form::input('text', 'company', null, ['class' => 'input']) }}
                    </div><!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
            {{ Form::close() }}
        </div>
        <!-- /.row --> --}}
    @endunless
    <div class="row">
        <div class="col-12">
            @if ($services->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">Aún no hay servicios</h2>
                    <!-- /.title -->
                    <a href="{{ url('servicios/nuevo') }}" class="btn btn-blue">Generar un servicio</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Cliente</th>
                            <th>Contacto</th>
                            <th>Fecha de entrega</th>
                            <th>Fecha de término</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            @php
                                $now = \Date::now();
                                $start = \Date::createFromFormat('Y-m-d', $service->date_start);
                                $end = \Date::createFromFormat('Y-m-d', $service->date_end);
                            @endphp
                            <tr>
                                <td>{{ $service->event }}</td>
                                <td>{{ $service->client->company }}</td>
                                <td>{{ $service->client->name }}</td>
                                <td>{{ ucfirst($start->diffForHumans()) }}</td>
                                <td>{{ ucfirst($end->diffForHumans()) }}</td>
                                <td>
                                    @if ($service->status == 'Terminada')
                                        <span class="badge badge-blue">Terminada</span>
                                    @elseif($now->gt($end))
                                        <span class="badge badge-red">Vencida</span>
                                    @elseif($now->lt($end))
                                        <span class="badge badge-green">Vigente</span>
                                    @endif
                                </td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('servicios/'.$service->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            {{-- <li class="item">
                                                <a href="{{ url('servicios/'.$service->id.'/download') }}" class="link"><i class="typcn typcn-download"></i> Descargar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <a href="{{ url('servicios/'.$service->id.'/pdf') }}" class="link" target="_blank"><i class="typcn typcn-printer"></i> Imprimir</a>
                                            </li>
                                            <!-- /.item --> --}}
                                            <li class="item">
                                                {{ Form::open(['url' => url('servicios', $service->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
                                                    <button type="submit" class="link"><i class="typcn typcn-delete"></i> Eliminar</button>
                                                {{ Form::close() }}
                                            </li>
                                            <!-- /.item -->
                                        </ul>
                                        <!-- /.list -->
                                    </span><!-- /.dropdown -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table -->
            @endif
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="pagination">
                {{ $services->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
