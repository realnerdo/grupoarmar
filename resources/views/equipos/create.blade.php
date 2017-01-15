@extends('layout.base')

@section('title', 'Equipos')
@section('sectionTitle', 'Agregar nuevo equipo')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($equipment = new \App\Equipment, ['url' => url('equipos'), 'files' => true, 'class' => 'form']) }}
                @include('equipos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
