@extends('admin.layouts.master')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

@endsection
@section('page-title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Client List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Clients</a></li>
                    <li class="breadcrumb-item active">Client List</li>
                </ol>

                @if(session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('button')
<div class="row pb-4 gy-3">
    <div class="col-sm-4">
        <a href="{{route('client.create')}}" class="btn btn-primary"><i class="las la-plus me-1"></i> Add Client</a>
    </div>
</div>
@endsection

@section('content')

<div class="row">
  <div class="card">
    <div class="card-body">
        <table id="clientsTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                 
                    <th>Address</th>
                     
                    <th>Phone</th>
                     <th>Command </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                     
                    <td>{{ $client->address }}</td>
                    
                    <td>{{ $client->phone }}</td>
                    <td>{{$client->commandToday()?->status  ?? '-'}}</td>
                    <td>
                        <a href="{{ route('client.edit', $client) }}" class="btn btn-sm btn-outline-primary">
                            <i class="las la-pen"></i>
                        </a>

                        <form action="{{ route('client.destroy', $client) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="las la-trash-alt"></i>
                            </button>
                        </form>

                        <button type="button" class="btn btn-sm btn-outline-success mt-1" data-bs-toggle="modal" data-bs-target="#createCommandModal-{{$client->id}}">
                            <i class="las la-plus"></i> Command
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


</div>

 

@include('admin.modules.client.inc.create-command')
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#clientsTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "Rechercher:",
                lengthMenu: "Afficher _MENU_ entrées",
                info: "Affiche _START_ à _END_ sur _TOTAL_ entrées",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                },
                emptyTable: "Aucune donnée disponible"
            }
        });
    });
</script>


@endsection