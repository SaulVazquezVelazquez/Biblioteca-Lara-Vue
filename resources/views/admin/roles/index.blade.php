@extends('adminlte::page')

@section('title', 'Index Roles')

@section('content_header')
    <h1>Index Roles</h1>
@stop

@section('content')

@if (session('rolesD'))
    <div class="alert alert-dismissible alert-success">
        <strong>
            {{session('rolesD')}}
        </strong>
    </div>
@endif

@if (session('rolesS'))
    <div class="alert alert-success">
        <strong>
            {{session('rolesS')}}
        </strong>
    </div>
@endif 

<div class="card">
    <div class="card-body">
        <div class="card-header">
            Table Roles
            <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-secondary float-right">Crear Nuevo</a>    
        </div>
        <div class="card-body">
            <table id="table-roles" class="table table-dark table-striped table-hover dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>

                        <td> <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-m btn-primary">Edit</a>

                        {!! Form::model($role, ['route' => ['admin.roles.destroy',$role] ,'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => ' btn btn-m btn-danger']) !!}
                        {!! Form::close() !!}
                        </td>
                    </tr>    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="style.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-roles').DataTable({
                responsive : true,
                autoWidth: false, 

                "language": {
                "lengthMenu": "Mostrar " + `
                                    <select class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="-1">All</option>
                                    </select>
                                        ` + " registros por pagina",
                "zeroRecords": "No hay registros - Disculpa",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros encontrados",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search" : "Buscar:",
                "paginate" : {
                    "next" : "Siguiente" ,
                    "previous" : "Anterior" 
                }
                }

            });
        } );
    </script>
@stop