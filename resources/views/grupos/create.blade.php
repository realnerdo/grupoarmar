@extends('layout.base')

@section('title', 'Grupos')
@section('sectionTitle', 'Agregar nuevo grupo')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($group = new \App\Group, ['url' => url('grupos'), 'class' => 'form']) }}
                @include('grupos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
