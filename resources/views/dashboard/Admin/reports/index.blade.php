@extends('dashboard.layout')
@section('title')
    Invoice
@endsection
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Reports</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('') }}">X-POINT</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Reports
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
                                <h3 class="card-title">Reports</h3>
                                {{-- <div class="card-tools">
                                    <button id="add-admin-modal" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#new-modal">
                                        Add User
                                    </button>
                                </div> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <div class="row">
                                    <div class="col-12">
                                        {{-- Holding Invoices --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">Room PS: {{ $room_cost }} L.E.</h3>
                                            </div>
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">Open PS: {{ $open_cost }} L.E.</h3>
                                            </div>
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">Air Hocky: {{ $air_cost }} L.E.</h3>
                                            </div>
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">Billiard: {{ $billiard_cost }} L.E.</h3>
                                            </div>

                                            {{-- <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Client</th>
                                                            <th>Mobile</th>
                                                            <th>Room</th>
                                                            <th>Time/min</th>
                                                            <th>Cost</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="callout callout-warning">
                                                        @foreach ($invoices_holding as $invoice)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $invoice->user->first_name . ' ' . $invoice->user->last_name }}
                                                                </td>
                                                                <td>{{ $invoice->user->mobile }}</td>
                                                                <td>{{ $invoice->name }}</td>
                                                                @php
                                                                    $cost = 0;
                                                                    $time = 0;
                                                                    foreach ($invoice->invoice_details as $detail) {
                                                                        $cost += $detail->cost;
                                                                        $time += $detail->time;
                                                                    }
                                                                @endphp
                                                                <td>{{ $time }}</td>
                                                                <td>{{ $cost }}</td>
                                                                <td>{{ $invoice->status }}</td>
                                                                <td>
                                                                    <a href="{{ url("dashboard/invoices/pay/$invoice->id") }}"
                                                                        class="btn btn-success btn-sm" @popper(Pay)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                    <a href="{{ url("dashboard/invoices/unpaid/$invoice->id") }}"
                                                                        class="btn btn-danger btn-sm" @popper(Unpaid)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
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
@endsection
