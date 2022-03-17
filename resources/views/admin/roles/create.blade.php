@extends('adminlte::page')

@section('title', 'Crear Role')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-header">
            Formulario Crear Rol
            <a href="{{route('admin.roles.index')}}" class="btn btn-secondary btn-sm float-right ">Regresar</a>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>'admin.roles.store','method'=>'POST']) !!}
            <div class="form-group">
                {!! Form::label(null, 'Name:', ['class'=>'label']) !!}  
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            
        
            <h2 class="h5 mt-2">Lista de Permisos</h2>
            @foreach ($permissions as $permission)
            <div>
                <label>
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
                    {{$permission->description}}
                </label>
            </div>
            @endforeach
            {!! Form::submit('Create', ['class'=>'btn btn-sm btn-block btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    {{-- <link rel="stylesheet" href="style.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>

@stop