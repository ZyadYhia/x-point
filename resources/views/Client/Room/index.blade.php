@extends('Client.layout')
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
                                            <form id="add-new-form"
                                                @if ($room->status == 'available') action="{{ url('dashboard/rooms/open') }}"
                                            @else action="{{ url('dashboard/rooms/close') }}" @endif
                                                method="POST">
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
                                            <div class="modal-footer justify-content-between">
                                                <a href="{{ url()->previous() }}" class="btn btn-primary"
                                                    data-dismiss="modal">Back</a>
                                                <button type="submit" form="add-new-form"
                                                    class="btn btn-success">Submit</button>
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
@endsection
