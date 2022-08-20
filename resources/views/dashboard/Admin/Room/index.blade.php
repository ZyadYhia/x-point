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
                        <h1 class="m-0 text-dark">Rooms</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('') }}">X-POINT</a>
                            </li>
                            {{-- <li class="breadcrumb-item ">
                                <a href="{{ url('dashboard') }}">Rooms</a>
                            </li> --}}
                            <li class="breadcrumb-item active">
                                Control Rooms
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
                                <h3 class="card-title">Rooms</h3>
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

                                        {{-- Room --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">{{ $room->name }}</h3>
                                                <div class="card-tools">
                                                    <button id="add-admin-modal" type="button"
                                                        class="btn btn-warning btn-sm new-btn"
                                                        data-room-type-name="{{ $room->name }}"
                                                        data-room-type-id="{{ $room->id }}" data-toggle="modal"
                                                        data-target="#new-modal">
                                                        Add {{ $room->name }}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Cost</th>
                                                            <th>Points</th>
                                                            <th>Multi-Percentage</th>
                                                            <th>Minimum Running Cost</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="callout callout-success">
                                                        @foreach ($rooms as $room)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $room->name }}</td>
                                                                <td>{{ $room->cost }}</td>
                                                                <td>{{ $room->discount }}</td>
                                                                <td>{{ $room->multi }}</td>
                                                                <td>{{ $room->minimum_cost }}</td>
                                                                <td>
                                                                    <button type="button" @popper(Edit {{ $room->name }})
                                                                        class="btn btn-info btn-sm edit-btn"
                                                                        data-room="{{ $room->name }}"
                                                                        data-id="{{ $room->id }}"
                                                                        data-min-cost="{{ $room->minimum_cost }}"
                                                                        data-name="{{ $room->name }}"
                                                                        data-cost="{{ $room->cost }}"
                                                                        data-points="{{ $room->discount }}"
                                                                        data-multi="{{ $room->multi }}"
                                                                        data-toggle="modal" data-target="#edit-modal">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <a href="{{ url("dashboard/rooms/control/delete/$room->id") }}"
                                                                        class="btn btn-danger btn-sm del"><i
                                                                            class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- Open --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">{{ $open->name }}</h3>
                                                <div class="card-tools">
                                                    <button id="add-admin-modal" type="button"
                                                        class="btn btn-warning btn-sm new-btn"
                                                        data-room-type-name="{{ $open->name }}"
                                                        data-room-type-id="{{ $open->id }}" data-toggle="modal"
                                                        data-target="#new-modal">
                                                        Add {{ $open->name }}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Cost</th>
                                                            <th>Points</th>
                                                            <th>Multi-Percentage</th>
                                                            <th>Minimum Running Cost</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="callout callout-success">
                                                        @foreach ($opens as $open)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $open->name }}</td>
                                                                <td>{{ $open->cost }}</td>
                                                                <td>{{ $open->discount }}</td>
                                                                <td>{{ $open->multi }}</td>
                                                                <td>{{ $open->minimum_cost }}</td>
                                                                <td>
                                                                    <button type="button" @popper(Edit {{ $open->name }})
                                                                        class="btn btn-info btn-sm edit-btn"
                                                                        data-room="{{ $open->name }}"
                                                                        data-id="{{ $open->id }}"
                                                                        data-min-cost="{{ $open->minimum_cost }}"
                                                                        data-name="{{ $open->name }}"
                                                                        data-cost="{{ $open->cost }}"
                                                                        data-points="{{ $open->discount }}"
                                                                        data-multi="{{ $open->multi }}"
                                                                        data-toggle="modal" data-target="#edit-modal">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <a href="{{ url("dashboard/rooms/control/delete/$open->id") }}"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- Air Hocky --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">{{ $air->name }}</h3>
                                                <div class="card-tools">
                                                    <button id="add-admin-modal" type="button"
                                                        class="btn btn-warning btn-sm new-btn"
                                                        data-room-type-name="{{ $air->name }}"
                                                        data-room-type-id="{{ $air->id }}" data-toggle="modal"
                                                        data-target="#new-modal">
                                                        Add {{ $air->name }}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Cost</th>
                                                            <th>Points</th>
                                                            <th>Minimum Running Cost</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="callout callout-success">
                                                        @foreach ($air_hockies as $air_hockie)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $air_hockie->name }}</td>
                                                                <td>{{ $air_hockie->cost }}</td>
                                                                <td>{{ $air_hockie->discount }}</td>
                                                                <td>{{ $air_hockie->minimum_cost }}</td>
                                                                <td>
                                                                    <button type="button" @popper(Edit {{ $air_hockie->name }})
                                                                        class="btn btn-info btn-sm edit-btn"
                                                                        data-room="{{ $air_hockie->name }}"
                                                                        data-id="{{ $air_hockie->id }}"
                                                                        data-min-cost="{{ $air_hockie->minimum_cost }}"
                                                                        data-name="{{ $air_hockie->name }}"
                                                                        data-cost="{{ $air_hockie->cost }}"
                                                                        data-points="{{ $air_hockie->discount }}"
                                                                        data-multi="{{ $air_hockie->multi }}"
                                                                        data-toggle="modal" data-target="#edit-modal">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <a href="{{ url("dashboard/rooms/control/delete/$air_hockie->id") }}"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        {{-- Billiard --}}
                                        <div class="card">
                                            <div class="callout callout-success card-header">
                                                <h3 class="card-title">{{ $Billiard->name }}</h3>
                                                <div class="card-tools">
                                                    <button id="add-admin-modal" type="button"
                                                        class="btn btn-warning btn-sm new-btn"
                                                        data-room-type-name="{{ $Billiard->name }}"
                                                        data-room-type-id="{{ $Billiard->id }}" data-toggle="modal"
                                                        data-target="#new-modal">
                                                        Add {{ $Billiard->name }}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Cost</th>
                                                            <th>Points</th>
                                                            <th>Minimum Running Cost</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="callout callout-success">
                                                        @foreach ($Billiards as $Billiard)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $Billiard->name }}</td>
                                                                <td>{{ $Billiard->cost }}</td>
                                                                <td>{{ $Billiard->discount }}</td>
                                                                <td>{{ $Billiard->minimum_cost }}</td>
                                                                <td>
                                                                    <button type="button" @popper(Edit {{ $Billiard->name }})
                                                                        class="btn btn-info btn-sm edit-btn"
                                                                        data-room="{{ $Billiard->name }}"
                                                                        data-id="{{ $Billiard->id }}"
                                                                        data-min-cost="{{ $Billiard->minimum_cost }}"
                                                                        data-name="{{ $Billiard->name }}"
                                                                        data-cost="{{ $Billiard->cost }}"
                                                                        data-points="{{ $Billiard->discount }}"
                                                                        data-multi="{{ $Billiard->multi }}"
                                                                        data-toggle="modal" data-target="#edit-modal">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <a href="{{ url("dashboard/rooms/control/delete/$Billiard->id") }}"
                                                                        class="btn btn-danger btn-sm"><i
                                                                            class="fas fa-trash"></i></a>
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

    <div class="modal fade" id="new-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New <span id="new-modal-header"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-new-cat-form" action="{{ url('dashboard/rooms/control/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_type_id" id="new-cat-form-id">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" name="cost">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Points</label>
                                    <input type="text" class="form-control" name="points">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Multi-Percentage</label>
                                    <input type="text" class="form-control" name="multi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Minimum Running Cost</label>
                                    <input type="text" class="form-control" name="minimum_cost">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-new-cat-form" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" <h4 class="modal-title">Edit <span id="edit-modal-header"></span> Room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-cat-form" action="{{ url('dashboard/rooms/control/update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit-cat-form-id">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="edit-cat-form-name" name="name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" id="edit-cat-form-cost" name="cost">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Points</label>
                                    <input type="text" class="form-control" id="edit-cat-form-points" name="points">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Multi-Percentage</label>
                                    <input type="text" class="form-control" id="edit-cat-form-multi" name="multi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Minimum Running Cost</label>
                                    <input type="text" class="form-control" id="edit-cat-form-min-cost"
                                        name="minimum_cost">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit-cat-form" class="btn btn-primary">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function() {

            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            let cost = $(this).attr('data-cost');
            let points = $(this).attr('data-points');
            let multi = $(this).attr('data-multi');
            let minimum_cost = $(this).attr('data-min-cost');
            $('#edit-cat-form-id').val(id)
            $('#edit-cat-form-name').val(name)
            $('#edit-cat-form-cost').val(cost)
            $('#edit-cat-form-points').val(points)
            $('#edit-cat-form-multi').val(multi)
            $('#edit-cat-form-min-cost').val(minimum_cost)

            let room = $(this).attr('data-room');
            $("#edit-modal-header").html(room);
        })
        $('.new-btn').click(function() {
            let room = $(this).attr('data-room-type-name');
            $("#new-modal-header").html(room);
            let id = $(this).attr('data-room-type-id');
            $('#new-cat-form-id').val(id)
        })
    </script>
@endsection
