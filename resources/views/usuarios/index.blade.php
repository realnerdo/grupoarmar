@extends('layout.base')

@section('title', 'Usuarios')
@section('sectionTitle', 'Usuarios')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('usuarios/exportExcel') }}" class="btn btn-green add"><i class="typcn typcn-download"></i> Exportar a Excel</a>
        <a href="{{ url('usuarios/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Nuevo usuario</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    <div class="row">
        {{ Form::open(['url' => url('usuarios'), 'class' => 'form search', 'method' => 'GET']) }}
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('name', 'Nombre', ['class' => 'label']) }}
                    {{ Form::input('text', 'name', ($request->has('name')) ? $request->input('name') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-4 -->
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('username', 'Usuario', ['class' => 'label']) }}
                    {{ Form::input('text', 'username', ($request->has('username')) ? $request->input('username') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-4 -->
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('email', 'Correo electrónico', ['class' => 'label']) }}
                    {{ Form::input('text', 'email', ($request->has('email')) ? $request->input('email') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-4 -->
            <div class="col-3">
                <div class="form-group">
                    {{ Form::submit('Buscar', ['class' => 'btn btn-green']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-3 -->
        {{ Form::close() }}
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            @if ($users->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">No se encontraron resultados</h2>
                    <!-- /.title -->
                    <a href="{{ url('usuarios/nuevo') }}" class="btn btn-blue">Agregar un usuario</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Correo electrónico</th>
                            <th>Registro</th>
                            <th>Servicios</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }} {!! ($user->role == 'admin') ? '<span class="badge badge-blue">Administrador</span>' : '<span class="badge badge-blue">Empleado</span>' !!}</td>
                                <td>{{ $user->username }}</td>
                                <td><a href="mailto:{{ $user->email }}" class="link">{{ $user->email }}</a></td>
                                <td>{{ ucfirst(\Date::createFromFormat('Y-m-d H:i:s', $user->created_at)->diffForHumans()) }}</td>
                                <td><a href="{{ url('servicios') }}" class="link">{{ $user->services()->count() }}</a></td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('usuarios/'.$user->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                <a href="{{ url('servicios') }}" class="link"><i class="typcn typcn-clipboard"></i> Servicios</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                {{ Form::open(['url' => url('usuarios', $user->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
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
                {{ $users->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
