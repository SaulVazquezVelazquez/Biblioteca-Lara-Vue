@extends('adminlte::page')

@section('title', 'Prestamo in Biblioteca')

@section('content_header')
    
@stop

@section('content')
    <div id="prestamos">
        <prestamos :idsesion="{{Auth::user()->id}}" />
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop