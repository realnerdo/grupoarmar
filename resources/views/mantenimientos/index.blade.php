@extends('layout.base')

@section('title', 'Mantenimiento de equipos')
@section('sectionTitle', 'Mantenimiento de equipos')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('mantenimientos/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Agregar mantenimiento</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    @unless ($maintenances->isEmpty())
        {{-- <div class="row">
            {{ Form::open(['url' => '/', 'class' => 'form']) }}
                <div class="col-6">
                    <div class="form-group">
                        {{ Form::label('title', 'Título', ['class' => 'label']) }}
                        {{ Form::input('text', 'title', null, ['class' => 'input']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-6 -->
                <div class="col-6">
                    <div class="form-group">
                        {{ Form::label('description', 'Descripción', ['class' => 'label']) }}
                        {{ Form::input('text', 'description', null, ['class' => 'input']) }}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-6 -->
            {{ Form::close() }}
        </div>
        <!-- /.row --> --}}
    @endunless
    <div class="row">
        <div class="col-12">
            @if ($maintenances->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">Aún no hay mantenimientos</h2>
                    <!-- /.title -->
                    <a href="{{ url('mantenimientos/nuevo') }}" class="btn btn-blue">Agregar un mantenimiento</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Causa/Desperfecto</th>
                            <th>Descripción</th>
                            <th>Fecha de realización</th>
                            <th>Lugar de mantenimiento</th>
                            <th>Encargado de mantenimiento</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenances as $maintenance)
                            <tr>
                                <td>{{ $maintenance->equipment->title }}</td>
                                <td>{{ $maintenance->reason }}</td>
                                <td>{{ $maintenance->description }}</td>
                                <td>{{ ucfirst(\Date::createFromFormat('Y-m-d', $maintenance->perform_date)->diffForHumans()) }}</td>
                                <td>{{ $maintenance->place }}</td>
                                <td>{{ $maintenance->responsible }}</td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('mantenimientos/'.$maintenance->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                {{ Form::open(['url' => url('mantenimientos', $maintenance->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
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
                {{ $maintenances->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
