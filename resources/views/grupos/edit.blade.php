@extends('layout.base')

@section('title', 'Grupos')
@section('sectionTitle', 'Editar datos del grupo')

@section('content')
    <div class="row">
        <div class="col-6">
            {{ Form::model($group, ['url' => url('grupos', $group->id), 'class' => 'form', 'method' => 'PATCH']) }}
                @include('grupos.form')
            {{ Form::close() }}
        </div>
        <!-- /.col-6 -->
    </div>
    <!-- /.row -->
@endsection
