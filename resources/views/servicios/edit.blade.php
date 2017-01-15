@extends('layout.base')

@section('title', 'Servicios')
@section('sectionTitle', 'Editar servicio')

@section('content')
    <ul class="notifications">
    @foreach($errors->all() as $error)

      <li class="notification error">
        <div class="message"><span class="typcn typcn-warning"></span> {{ $error }}</div>
      </li>
    @endforeach

    </ul>
    <div class="row">
        <div class="col-12">
            {{ Form::model($service, ['url' => url('servicios', $service->id), 'class' => 'form', 'method' => 'PATCH']) }}
                @include('servicios.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
