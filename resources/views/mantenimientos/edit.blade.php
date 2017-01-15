@extends('layout.base')

@section('title', 'Mantenimiento de equipos')
@section('sectionTitle', 'Editar datos del mantenimiento')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($maintenance, ['url' => url('mantenimientos', $maintenance->id), 'class' => 'form', 'method' => 'PATCH']) }}
                @include('mantenimientos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
