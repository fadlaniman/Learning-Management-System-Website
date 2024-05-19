@extends('layout.index')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small Box (Stat card) -->    
            <div class="row">
                @foreach ($users->classes as $class)
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>{{$class->name}}</h4>

                            <p>{{$class->description}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="{{url('/teacher/classes/attendance/' . $class->id)}}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endsection