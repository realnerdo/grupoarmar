@extends('layout.base')

@section('title', 'Equipos')
@section('sectionTitle', 'Editar datos del equipo')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($equipment, ['url' => url('equipos', $equipment->id), 'files' => true, 'class' => 'form', 'method' => 'PATCH']) }}
                @include('equipos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
