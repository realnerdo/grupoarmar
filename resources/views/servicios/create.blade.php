@extends('layout.base')

@section('title', 'Servicios')
@section('sectionTitle', 'Generar nuevo servicio')

@section('content')
    <ul class="errors">
    @foreach($errors->all() as $error)

      <li class="error">
        <div class="message"><span class="typcn typcn-warning"></span> {{ $error }}</div>
      </li>
    @endforeach

    </ul>
    <div class="row">
        <div class="col-12">
            {{ Form::model($service = new \App\Service, ['url' => url('servicios'), 'class' => 'form']) }}
                @include('servicios.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
