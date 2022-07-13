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
                    <div class="col-12 pb-3">
                        <form id="add-new-form"
                            @if ($room->status == 'available') action="{{ url('dashboard/rooms/open') }}" @else action="{{ url('dashboard/rooms/close') }}" @endif
                            method="POST">
                            @csrf
                            <input type="hidden" name="room" value="{{ $room->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>User Name:</label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-primary" data-dismiss="modal">Back</a>
                            <button type="submit" form="add-new-form" class="btn btn-success">Submit</button>
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
