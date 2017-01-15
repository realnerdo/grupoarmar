@extends('layout.base')

@section('title', 'Almacenes')
@section('sectionTitle', 'Editar datos del almacén')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($warehouse, ['url' => url('almacenes', $warehouse->id), 'class' => 'form', 'method' => 'PATCH']) }}
                @include('almacenes.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
