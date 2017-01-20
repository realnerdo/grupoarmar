@extends('layout.base')

@section('title', 'Equipos')
@section('sectionTitle', 'Equipos')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('equipos/etiquetas') }}" class="btn btn-blue" target="_blank"><i class="typcn typcn-tags"></i> Etiquetas</a>
        <a href="{{ url('equipos/exportExcel') }}" class="btn btn-green"><i class="typcn typcn-download"></i> Exportar a Excel</a>
        <a href="{{ url('equipos/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Agregar equipo</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    @unless ($equipments->isEmpty())
        {{-- <div class="row">
            {{ Form::open(['url' => '/', 'class' => 'form']) }}
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('title', 'Título', ['class' => 'label']) }}
                        {{ Form::input('text', 'title', null, ['class' => 'input']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('code', 'Código', ['class' => 'label']) }}
                        {{ Form::input('text', 'code', null, ['class' => 'input']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('brand', 'Marca', ['class' => 'label']) }}
                        {{ Form::select('brand', $brands, null, ['class' => 'select2']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
                <div class="col-3">
                    <div class="form-group">
                        {{ Form::label('category', 'Categoría', ['class' => 'label']) }}
                        {{ Form::select('category', $categories, null, ['class' => 'select2']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-3 -->
            {{ Form::close() }}
        </div>
        <!-- /.row --> --}}
    @endunless
    <div class="row">
        <div class="col-12">
            @if ($equipments->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">Aún no hay equipos</h2>
                    <!-- /.title -->
                    <a href="{{ url('equipos/nuevo') }}" class="btn btn-blue">Agregar un equipo</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Descripción</th>
                            <th>Disponibles</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->folio }}</td>
                                <td>
                                    <h4 class="equipment-title">{{ $equipment->title }}</h4>
                                    <!-- /.equipment-title -->
                                    <h5 class="equipment-brand"><b>Marca:</b> <i>{{ $equipment->brand->title }}</i></h5>
                                    <!-- /.equipment-brand -->
                                    <h5 class="equipment-warehouse"><b>Almacén:</b> <i>{{ $equipment->warehouse->title }}</i></h5>
                                    <!-- /.equipment-warehouse -->
                                    <h5 class="equipment-group"><b>Grupo:</b> <i>{{ $equipment->group->title }}</i></h5>
                                    <!-- /.equipment-group -->
                                    <div class="equipment-description">
                                        {{ $equipment->description }}
                                    </div>
                                    <!-- /.equipment-description -->
                                </td>
                                <td>{{ $equipment->stock }}</td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('equipos/'.$equipment->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                {{ Form::open(['url' => url('equipos', $equipment->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
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
                {{ $equipments->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('modal')
    <div class="layer" id="upload-excel-modal">
        <div class="modal">
            <h3 class="title"><i class="typcn typcn-storage"></i> Subir archivo <button class="close-modal"><i class="typcn typcn-times"></i></button></h3>
            <!-- /.title -->
            <div class="content">
                {{ Form::open(['url' => url('equipos/importEquipments'), 'files' => true,'class' => 'form']) }}
                    <div class="form-group">
                        {{ Form::label('file', 'Selecciona un archivo .xsl, .xlsx o .csv', ['class' => 'label']) }}
                        {{ Form::file('file', null, ['class' => 'input']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Cargar equipos', ['class' => 'btn btn-green']) }}
                    </div>
                    <!-- /.form-group -->
                {{ Form::close() }}
            </div>
            <!-- /.content -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.layer -->
@endsection
