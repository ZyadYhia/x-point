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
                        <h1 class="m-0 text-dark">Invoice</h1>
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
                                Invoice
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
                                <h3 class="card-title">Invoice</h3>
                                {{-- <div class="card-tools">
                                    <button id="add-admin-modal" type="button" class="btn btn-primary "
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
                                            <div class="callout callout-warning card-header">
                                                <h3 class="card-title">Holding Invoices</h3>
                                            </div>

                                            <div class="card-body table-responsive p-0">
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
                                                                    $min_cost = 0;
                                                                    $time = 0;
                                                                    foreach ($invoice->invoice_details as $detail) {
                                                                        $cost += $detail->cost;
                                                                        $time += $detail->time;
                                                                        $min_cost = $detail->room->minimum_cost ? $detail->room->minimum_cost : 0;
                                                                    }
                                                                    $cost -= $invoice->points;
                                                                @endphp
                                                                <td>{{ $time }}</td>
                                                                {{-- <td><span class="tag tag-success">{{ $invoice->invoice_details[0]->cost }}</span></td> --}}
                                                                <td>{{ $cost }}</td>
                                                                <td>{{ $invoice->status }}</td>
                                                                <td>
                                                                    <button @popper(View) id="invoice-modal"
                                                                        type="button" class="btn btn-warning view-btn"
                                                                        data-toggle="modal"
                                                                        data-invoice-id="{{ $invoice->id }}"
                                                                        data-room="{{ $invoice->name }}"
                                                                        data-time="{{ $time }}"
                                                                        data-cost="{{ $cost }}"
                                                                        data-min-cost="{{ $min_cost }}"
                                                                        data-points="{{ $invoice->user->points }}"
                                                                        data-target="#modal-lg-invoice" @popper(View)>
                                                                        <i class="fa-solid fa-street-view"></i>
                                                                    </button>
                                                                    <a href="{{ url("dashboard/invoices/pay/$invoice->id") }}"
                                                                        class="btn btn-success " @popper(Pay)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                    <a href="{{ url("dashboard/invoices/unpaid/$invoice->id") }}"
                                                                        class="btn btn-danger " @popper(Unpaid)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- Paid Invoices --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">Paid Invoices</h3>
                                            </div>

                                            <div class="card-body table-responsive p-0">
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
                                                    <tbody class="callout callout-success">
                                                        @foreach ($invoices_paid as $invoice)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $invoice->user->first_name . ' ' . $invoice->user->last_name }}
                                                                </td>
                                                                <td>{{ $invoice->user->mobile }}</td>
                                                                <td>{{ $invoice->name }}</td>
                                                                @php
                                                                    $cost = 0;
                                                                    $min_cost = 0;
                                                                    $time = 0;
                                                                    foreach ($invoice->invoice_details as $detail) {
                                                                        $cost += $detail->cost;
                                                                        $time += $detail->time;
                                                                        $min_cost = $detail->room->minimum_cost ? $detail->room->minimum_cost : 0;
                                                                    }
                                                                    $cost -= $invoice->points;
                                                                @endphp
                                                                <td>{{ $time }}</td>
                                                                {{-- <td><span class="tag tag-success">{{ $invoice->invoice_details[0]->cost }}</span></td> --}}
                                                                <td>{{ $cost }}</td>
                                                                <td>{{ $invoice->status }}</td>
                                                                <td>

                                                                    <a href="{{ url("dashboard/invoices/unpaid/$invoice->id") }}"
                                                                        class="btn btn-danger " @popper(Unpaid)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- UnPaid Invoices --}}
                                        <div class="card">
                                            <div class="callout callout-danger card-header">
                                                <h3 class="card-title">Unpaid Invoices</h3>
                                            </div>

                                            <div class="card-body table-responsive p-0">
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
                                                    <tbody class="callout callout-danger">
                                                        @foreach ($invoices_unpaid as $invoice)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $invoice->user->first_name . ' ' . $invoice->user->last_name }}
                                                                </td>
                                                                <td>{{ $invoice->user->mobile }}</td>
                                                                <td>{{ $invoice->name }}</td>
                                                                @php
                                                                    $cost = 0;
                                                                    $min_cost = 0;
                                                                    $time = 0;
                                                                    foreach ($invoice->invoice_details as $detail) {
                                                                        $cost += $detail->cost;
                                                                        $time += $detail->time;
                                                                        $min_cost = $detail->room->minimum_cost ? $detail->room->minimum_cost : 0;
                                                                    }
                                                                    $cost -= $invoice->points;
                                                                @endphp
                                                                <td>{{ $time }}</td>
                                                                {{-- <td><span class="tag tag-success">{{ $invoice->invoice_details[0]->cost }}</span></td> --}}
                                                                <td>{{ $cost }}</td>
                                                                <td>{{ $invoice->status }}</td>
                                                                <td>
                                                                    <button @popper(View) id="invoice-modal"
                                                                        type="button" class="btn btn-warning view-btn"
                                                                        data-toggle="modal"
                                                                        data-invoice-id="{{ $invoice->id }}"
                                                                        data-room="{{ $invoice->name }}"
                                                                        data-time="{{ $time }}"
                                                                        data-cost="{{ $cost }}"
                                                                        data-min-cost="{{ $min_cost }}"
                                                                        data-points="{{ $invoice->user->points }}"
                                                                        data-target="#modal-lg-invoice" @popper(View)>
                                                                        <i class="fa-solid fa-street-view"></i>
                                                                    </button>

                                                                    <a href="{{ url("dashboard/invoices/pay/$invoice->id") }}"
                                                                        class="btn btn-success " @popper(Pay)>
                                                                        <i class="fas fa-comment-dollar"></i>
                                                                    </a>
                                                                    {{-- <a href="{{ url("dashboard/invoices/user/$invoice->id") }}"
                                                                        class="btn btn-success " @popper(User)>
                                                                        <i class="fal fa-user"></i>
                                                                    </a> --}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

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


    <div class="modal fade" id="modal-lg-invoice" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">INVOICE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Room</th>
                                                <th>Time/min</th>
                                                <th>Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span id="view-invoice-form-room"></span></td>
                                                <td><span id="view-invoice-form-time"></span></td>
                                                <td><span id="view-invoice-form-cost"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <form id="points-form" action="{{ url('dashboard/invoices/add-points') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="points" id="points">
                                        <input type="hidden" name="invoice_id" id="invoice_id">
                                        <div class="row">
                                            {{-- <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="pointsWallet"
                                                    onclick="validate()" checked>
                                                <label for="pointsWallet" class="custom-control-label">Points
                                                    Included</label>
                                            </div> --}}
                                            {{-- <div class="form-group">
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input form="points-form" onclick="validate()" type="checkbox"
                                                    class="custom-control-input" id="pointsWallet">
                                                <label class="custom-control-label" for="pointsWallet">Toggle</label>
                                            </div>
                                             </div> --}}
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input form="points-form" onclick="validate()" type="checkbox" class="custom-control-input"
                            id="pointsWallet">
                        <label class="custom-control-label" id="pointsWalletLabel" for="pointsWallet">Use Points</label>
                    </div>
                    <button type="submit" form="points-form" class="btn btn-success">Use</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@include('dashboard.partials.JS.invoiceToggle')
@section('scripts')
    <script>
        $('.view-btn').click(function() {
            let id_invoice = $(this).attr('data-invoice-id');
            let room_invoice = $(this).attr('data-room');
            let time_invoice = $(this).attr('data-time');
            let cost_invoice = $(this).attr('data-cost');
            min_cost_invoice = Math.round(($(this).attr('data-min-cost') / 60) * time_invoice);
            let points_invoice = $(this).attr('data-points');
            old_cost = cost_invoice;
            points = points_invoice;
            console.log(room_invoice, time_invoice, cost_invoice, points_invoice);
            $('#view-invoice-form-room').html(room_invoice)
            $('#view-invoice-form-time').html(time_invoice)
            $('#view-invoice-form-cost').html(cost_invoice)
            //$('#view-invoice-form-points').val(points_invoice)
            // $('#view-invoice-form-invoice-id').val(points_invoice)
            $('#invoice_id').val(id_invoice)
            let room = $(this).attr('data-room');
            $("#view-modal-header").html(room_invoice);
            if ((old_cost - points) < min_cost_invoice) {
                available_points = old_cost - min_cost_invoice;
            } else {
                available_points = points;
            }
            // available_points = old_cost - min_cost_invoice;
            $("#pointsWalletLabel").html(`${available_points} points to use from ${points} points`);
            validate();
        });
    </script>
@endsection
