@extends('layout.base')

@section('title', 'Clientes')
@section('sectionTitle', 'Clientes')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('clientes/exportExcel') }}" class="btn btn-green add"><i class="typcn typcn-download"></i> Exportar a Excel</a>
        <a href="{{ url('clientes/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Nuevo cliente</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    <div class="row">
        {{ Form::open(['url' => url('clientes'), 'class' => 'form search', 'method' => 'GET']) }}
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('name', 'Nombre', ['class' => 'label']) }}
                    {{ Form::input('text', 'name', ($request->has('name')) ? $request->input('name') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-3 -->
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('email', 'Correo electrónico', ['class' => 'label']) }}
                    {{ Form::input('text', 'email', ($request->has('email')) ? $request->input('email') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-3 -->
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('phone', 'Teléfono', ['class' => 'label']) }}
                    {{ Form::input('text', 'phone', ($request->has('phone')) ? $request->input('phone') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-3 -->
            <div class="col-12">
                <div class="form-group">
                    {{ Form::submit('Buscar', ['class' => 'btn btn-green']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-12 -->
        {{ Form::close() }}
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            @if ($clients->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">No se encontraron resultados</h2>
                    <!-- /.title -->
                    <a href="{{ url('clientes/nuevo') }}" class="btn btn-blue">Agregar un cliente</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Teléfono</th>
                            <th>Fecha de registro</th>
                            <th>Servicios</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td><a href="mailto:{{ $client->email }}" class="link">{{ $client->email }}</a></td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->created_at }}</td>
                                <td><a href="{{ url('servicios') }}" class="link">{{ $client->services()->count() }}</a></td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('clientes/'.$client->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <a href="{{ url('servicios') }}" class="link"><i class="typcn typcn-clipboard"></i> Servicios</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                {{ Form::open(['url' => url('clientes', $client->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
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
                {{ $clients->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
