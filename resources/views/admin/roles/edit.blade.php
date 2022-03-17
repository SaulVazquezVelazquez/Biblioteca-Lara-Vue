@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
@if (session('rolesU'))
    <div class="alert alert-success">
        <strong>
            {{session('rolesU')}}
        </strong>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="card-header">
            Formulario Editar Rol
            <a href="{{route('admin.roles.index')}}" class="btn btn-secondary btn-sm float-right ">Regresar</a>
        </div>
        <div class="card-body">
            {!! Form::model($role, ['route'=>['admin.roles.update',$role],'method'=>'PUT']) !!}
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
            {!! Form::submit('Edit', ['class'=>'btn btn-sm btn-block btn-primary']) !!}
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