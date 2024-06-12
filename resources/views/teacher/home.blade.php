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
                        <li class="breadcrumb-item active"></li>
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                @foreach ($userclass as $class)
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gradient-primary">
                        <div class="inner">
                            <h4>{{$class->classes->name}}</h4>
                            <p>{{$class->classes->description}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="{{url('/teacher/classes/' .$class->classes->id . '/detail')}}" class="small-box-footer">
                            Open Class <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- Main content -->
</div>
@endsection