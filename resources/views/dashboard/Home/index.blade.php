@extends('dashboard.layout')
@section('title')
    Rooms
@endsection
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Starter Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            {{-- Room PS --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">{{ $room->name }}</h3>
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
                                        @foreach ($rooms as $room)
                                            <div class="col-lg-4 col-md-6">

                                                <div
                                                    class="small-box @if ($room->status == 'available') bg-success @else bg-danger @endif">
                                                    @if ($room->discount and $room->discount !== 0)
                                                        <div class="ribbon-wrapper ribbon-lg">
                                                            <div class="ribbon bg-warning text-lg">
                                                                {{ $room->discount }}% POINTS
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="inner">
                                                        <h3>{{ $room->name }}</h3>
                                                        <p>Status: <strong>{{ $room->status }}</strong> </p>
                                                        <p>Cost: <strong>{{ $room->cost }} </strong>LE/h </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fab fa-playstation"></i>
                                                    </div>
                                                    <a href="{{ url("dashboard/room/$room->id") }}"
                                                        class="small-box-footer">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /.row -->
            </div>

            {{-- Open PS --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">{{ $open->name }}</h3>
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
                                        @foreach ($opens as $open)
                                            <div class="col-lg-4 col-md-6">

                                                <div
                                                    class="small-box @if ($open->status == 'available') bg-success @else bg-danger @endif">
                                                    @if ($open->discount and $open->discount !== 0)
                                                        <div class="ribbon-wrapper ribbon-lg">
                                                            <div class="ribbon bg-warning text-lg">
                                                                {{ $open->discount }}% Points
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="inner">
                                                        <h3>{{ $open->name }}</h3>
                                                        <p>Status: <strong>{{ $open->status }}</strong> </p>
                                                        <p>Cost: <strong>{{ $open->cost }} </strong>LE/h </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fab fa-playstation"></i>
                                                    </div>
                                                    <a href="{{ url("dashboard/room/$open->id") }}"
                                                        class="small-box-footer">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /.row -->
            </div>

            {{-- Air Hocky --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">{{ $air->name }}</h3>
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
                                        @foreach ($air_hockies as $air_hocky)
                                            <div class="col-lg-4 col-md-6">

                                                <div
                                                    class="small-box @if ($air_hocky->status == 'available') bg-success @else bg-danger @endif">
                                                    @if ($air_hocky->discount and $air_hocky->discount !== 0)
                                                        <div class="ribbon-wrapper ribbon-lg">
                                                            <div class="ribbon bg-warning text-lg">
                                                                {{ $air_hocky->discount }}% POINTS
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="inner">
                                                        <h3>{{ $air_hocky->name }}</h3>
                                                        <p>Status: <strong>{{ $air_hocky->status }}</strong> </p>
                                                        <p>Cost: <strong>{{ $air_hocky->cost }} </strong>LE/h </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fal fa-ring"></i>
                                                    </div>
                                                    <a href="{{ url("dashboard/room/$air_hocky->id") }}"
                                                        class="small-box-footer">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- /.row -->
            </div>

            {{-- Pool --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">{{ $pool->name }}</h3>
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
                                        @foreach ($pools as $pool)
                                            <div class="col-lg-4 col-md-6">

                                                <div
                                                    class="small-box @if ($pool->status == 'available') bg-success @else bg-danger @endif">
                                                    @if ($pool->discount and $pool->discount !== 0)
                                                        <div class="ribbon-wrapper ribbon-lg">
                                                            <div class="ribbon bg-warning text-lg">
                                                                {{ $pool->discount }}% POINTS
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="inner">
                                                        <h3>{{ $pool->name }}</h3>
                                                        <p>Status: <strong>{{ $pool->status }}</strong> </p>
                                                        <p>Cost: <strong>{{ $pool->cost }} </strong>LE/h </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fab fa-playstation"></i>
                                                    </div>
                                                    <a href="{{ url("dashboard/room/$pool->id") }}"
                                                        class="small-box-footer">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
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
    <!-- /.content-wrapper -->
@endsection
