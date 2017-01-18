@extends('layout.base')

@section('title', 'Proveedores')
@section('sectionTitle', 'Agregar nuevo proveedor')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($supplier = new \App\Supplier, ['url' => url('proveedores'), 'class' => 'form']) }}
                @include('proveedores.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
