@extends('adminlte::page')

@section('title', 'Index Users')

@section('content_header')
    <h1>Index Users</h1>
@stop

@section('content')

@if (session('userS'))
    <div class="alert alert-dismissible alert-success">
        <strong>
            {{session('userS')}}
        </strong>
    </div>
@endif
@if (session('userD'))
    <div class="alert alert-success">
        <strong>
            {{session('userD')}}
        </strong>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="card-header">
            Table Users
            <a href="{{route('admin.user.create')}}" class="btn btn-secondary btn-sm float-right ">Create New User</a>
        </div>
        <div class="card-body">
            <table id="table-users" class="table table-dark table-striped table-hover dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        <td> <a href="{{route('admin.user.edit', $user)}}" class="btn btn-m btn-primary">Edit</a>
                        {!! Form::model($user, ['route' => ['admin.user.destroy',$user] ,'method' => 'DELETE']) !!}
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
            $('#table-users').DataTable({
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