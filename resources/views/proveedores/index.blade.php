@extends('layout.base')

@section('title', 'Proveedores')
@section('sectionTitle', 'Proveedores')
@section('add')
    <div class="buttons pr">
        <a href="{{ url('proveedores/exportExcel') }}" class="btn btn-green add"><i class="typcn typcn-download"></i> Exportar a Excel</a>
        <a href="{{ url('proveedores/nuevo') }}" class="btn btn-blue add"><i class="typcn typcn-plus"></i> Agregar proveedor</a>
    </div>
    <!-- /.buttons -->
@endsection

@section('content')
    <div class="row">
        {{ Form::open(['url' => url('proveedores'), 'class' => 'form search', 'method' => 'GET']) }}
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('title', 'Título', ['class' => 'label']) }}
                    {{ Form::input('text', 'title', ($request->has('title')) ? $request->input('title') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-6 -->
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('phone', 'Teléfono', ['class' => 'label']) }}
                    {{ Form::input('text', 'phone', ($request->has('phone')) ? $request->input('phone') : null, ['class' => 'input']) }}
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-6 -->
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
            @if ($suppliers->isEmpty())
                <div class="empty">
                    <i class="typcn typcn-coffee"></i>
                    <h2 class="title">No hay resultados</h2>
                    <!-- /.title -->
                    <a href="{{ url('proveedores/nuevo') }}" class="btn btn-blue">Agregar un proveedor</a>
                </div>
                <!-- /.empty -->
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Mantenimientos</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->title }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->maintenances()->count() }}</td>
                                <td>
                                    <span href="#" class="dropdown">
                                        <i class="typcn typcn-social-flickr"></i>
                                        <ul class="list">
                                            <li class="item">
                                                <a href="{{ url('proveedores/'.$supplier->id.'/editar') }}" class="link"><i class="typcn typcn-edit"></i> Editar</a>
                                            </li>
                                            <!-- /.item -->
                                            <li class="item">
                                                {{ Form::open(['url' => url('proveedores', $supplier->id), 'method' => 'DELETE', 'class' => 'delete-form']) }}
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
                {{ $suppliers->links() }}
            </div>
            <!-- /.pagination -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
