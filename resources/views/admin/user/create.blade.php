@extends('adminlte::page')

@section('title', 'CrearUser')

@section('content_header')
    <h1>Crear Users</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        {!! Form::open(['route'=>'admin.user.store','method'=>'POST']) !!} 

        <div class="form-grup">
            {!! Form::label('', 'Name', ['class'=>'label-control']) !!}
            {!! Form::text('name', null, ['placeholder'=>'Nombre','class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('', 'Email', ['class'=>'label-control']) !!}
            {!! Form::text('email', null, ['placeholder'=>'Last Name','class'=>'form-control','required']) !!}
        </div>
        <div class="form-goup">
            {!! Form::label('', 'Password', ['class'=>'label-control']) !!}
            {!! Form::password('password', ['class'=>'form-control mb-2','required']) !!}
        </div>
        <div class="form-goup">
            @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                    {{$role->name}}
                </label>
            </div>
            @endforeach

        </div>
        <div class="form-group">
            {!! Form::submit('Crear', ['class' => 'btn btn-sm btn-primary btn-block']) !!}
        </div>
        {!! Form::close() !!}

    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
