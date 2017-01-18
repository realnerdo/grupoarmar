@extends('layout.base')

@section('title', 'Proveedores')
@section('sectionTitle', 'Editar datos del proveedor')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($supplier, ['url' => url('proveedores', $supplier->id), 'class' => 'form', 'method' => 'PATCH']) }}
                @include('proveedores.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
