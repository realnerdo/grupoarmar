@extends('layout.base')

@section('title', 'Almacenes')
@section('sectionTitle', 'Agregar nuevo almacén')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($warehouse = new \App\Warehouse, ['url' => url('almacenes'), 'class' => 'form']) }}
                @include('almacenes.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
