@extends('layout.base')

@section('title', 'Mantenimiento de equipos')
@section('sectionTitle', 'Agregar nueva mantenimiento')

@section('content')
    <ul class="errors">
    @foreach($errors->all() as $error)

      <li class="error">
        <div class="message"><span class="typcn typcn-warning"></span> {{ $error }}</div>
      </li>
    @endforeach

    </ul>
    <div class="row">
        <div class="col-6">
            {{ Form::model($maintenance = new \App\Maintenance, ['url' => url('mantenimientos'), 'class' => 'form']) }}
                @include('mantenimientos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
