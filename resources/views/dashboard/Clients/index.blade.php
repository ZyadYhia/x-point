@extends('dashboard.layout')
@section('title')
    Clients
@endsection
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Clients</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('') }}">X-POINT</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ url('dashboard') }}">Rooms</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Clients
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Clients</h3>
                                <div class="card-tools">
                                    <button id="add-client-modal" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#new-modal">
                                        Add Client
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Verified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $client->first_name }}</td>
                                                <td>{{ $client->last_name }}</td>
                                                <td>{{ $client->mobile }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->role->name }}</td>
                                                <td>
                                                    @if ($client->email_verified_at)
                                                        <span class="badge badge-success">Verified</span>
                                                    @else
                                                        <span class="badge badge-danger">Not Verified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($client->role->name !== 'client')
                                                        <a data-swal-toast-template='#demote-template'
                                                            href="{{ url("dashboard/clients/demote/$client->id") }}"
                                                            class="btn btn-warning btn-sm"
                                                            {{-- class="btn btn-warning btn-sm @if (Auth::user()->id == $client->id) dem @endif " --}}
                                                            @popper(Demote)>
                                                            <i class="fas fa-level-down-alt"></i>
                                                        </a>
                                                    @endif
                                                    @if ($client->role->name == 'client')
                                                        <a href="{{ url("dashboard/clients/promote/$client->id") }}"
                                                            class="btn btn-success btn-sm" @popper(Promote)><i
                                                                class="fas fa-level-up-alt"></i></a>
                                                    @endif
                                                    <a data-swal-toast-template='#remove-template'
                                                        href="{{ url("dashboard/clients/delete/$client->id") }}"
                                                        class="btn btn-danger btn-sm del" @popper(Delete)>
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    @if ($client->email_verified_at)
                                                        <a href="{{ url("dashboard/clients/remove-verification/$client->id") }}"
                                                            class="btn btn-danger btn-sm" @popper(Remove verification)><i
                                                                class="fas fa-user-check"></i></a>
                                                    @else
                                                        <a href="{{ url("dashboard/clients/apply-verification/$client->id") }}"
                                                            class="btn btn-primary btn-sm" @popper(apply verification)><i
                                                                class="fas fa-user-check"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="new-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.partials.register')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-new-user" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
