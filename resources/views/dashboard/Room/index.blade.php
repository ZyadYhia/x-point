@extends('dashboard.layout')
@section('title')
    {{ $room->name }}
@endsection
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $room->name }}</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">Rooms</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $room->name }}
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
                                @if ($room->status == 'available')
                                    <h3 class="card-title">Open {{ $room->name }}</h3>
                                @else
                                    <h3 class="card-title">Close {{ $room->name }} </h3>
                                @endif
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-12 pb-3">
                                            @php
                                                $actionURL = $room->status == 'available' ? url('dashboard/rooms/open') : url('dashboard/rooms/close');
                                            @endphp
                                            <form id="open-close-form" action="{{ $actionURL }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="room" value="{{ $room->id }}">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>UserName/Email:</label>
                                                            <input type="text" class="form-control" name="username">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="password" class="form-control" name="password">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($room->status == 'available')
                                                    @if ($room_type == 'Open PS' or $room_type == 'Room PS')
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>Players</label>
                                                                    <select class="custom-select form-control-border"
                                                                        name="players">
                                                                        <option value="single">Single</option>
                                                                        <option value="multi">Multi-Player</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </form>
                                            <div class="row">

                                                <div class="modal-footer col-md-6 justify-content-between">
                                                    <a href="{{ url()->previous() }}" class="btn btn-primary"
                                                        data-dismiss="modal">Back</a>
                                                    <button type="submit" form="open-close-form"
                                                        class="btn btn-success">Submit</button>
                                                    @if ($room->status == 'available')
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modal-lg">
                                                            New User
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /.row -->
            </div>
        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.partials.register')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-new-user" class="btn btn-success">Add</button>
                </div>
            </div>

        </div>

    </div>
    <button id="invoice-modal" type="button" hidden class="btn btn-default" data-toggle="modal"
        data-target="#modal-lg-invoice">
        Launch Large Modal
    </button>
    @if (session('invoice'))
        {{-- <div class="modal fade" id="modal-lg-invoice"> --}}
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
                                                    <th>#</th>
                                                    <th>Room</th>
                                                    <th>Time/min</th>
                                                    <th>Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($invoices as $invoice) --}}
                                                <tr>
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
                                                    <input type="hidden" id="min_cost" value="{{ $min_cost }}">

                                                    <input type="hidden" id="user_points"
                                                        value="{{ $invoice->user->points }}">

                                                    <td>1</td>
                                                    <td>{{ $invoice->name }}</td>
                                                    <td id="time_invoice">{{ $time }}</td>
                                                    <td id="cost_invoice">{{ $cost }}</td>
                                                </tr>
                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="card-body">
                                        <form id="points-form" action="{{ url('dashboard/invoices/add-points') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="points" id="points">
                                            <input type="hidden" name="invoice_id" id="invoice_id"
                                                value="{{ $invoice->id }}">
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        @if ($invoice->points !== 0)
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input form="points-form" onclick="validate()" type="checkbox"
                                    class="custom-control-input" id="pointsWallet">
                                <label class="custom-control-label" id="pointsWalletLabel" for="pointsWallet">Use
                                    Points</label>
                            </div>
                        @endif
                        <button type="submit" id="points-link" form="points-form" class="btn btn-success">Use</button>
                    </div>
                </div>

            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        let old_cost = 1;
        let new_cost = 1;
        let points = 1;
        let available_points = 0;
        let min_cost_invoice = 0;
        // Autoclick and open Invoice Modal
        (function() {
            if (document.getElementById('session_invoice')) {
                document.getElementById('invoice-modal').click();
                // let id_invoice = $("#invoice_id").val();
                let cost_invoice = $("#cost_invoice").html();
                let points_invoice = $("#user_points").val();
                min_cost_invoice = $("#min_cost").val();
                old_cost = parseInt(cost_invoice, 10);
                points = points_invoice;

                if (old_cost != 0) {

                    available_points = old_cost - min_cost_invoice;
                }
                $("#pointsWalletLabel").html(`${available_points} points to use from ${points} points`);
            }
            validate();
        })();

        function validate() {
            //Toggle Switch
            let pointsWallet = document.getElementById('pointsWallet');
            if (pointsWallet.checked && old_cost != 0) {
                if (old_cost <= min_cost_invoice) {
                    new_cost = old_cost;
                } else {
                    new_cost = old_cost - points;
                }

                if (new_cost < min_cost_invoice) {
                    available_points = old_cost - min_cost_invoice;
                    new_cost = old_cost - available_points;
                    $("#pointsWalletLabel").html(`${available_points} points used from ${points} points`);
                }
                $('#cost_invoice').html(new_cost)
                $('#points').val(available_points)
            } else {
                $('#points').val(0)
                $('#cost_invoice').html(old_cost)
                $("#pointsWalletLabel").html(`${available_points} points to use from ${points} points`);
            }
        }
        $("#points-link").click(function(e) {
            e.preventDefault();
            $("#points-form").submit();
        });
    </script>
@endsection
