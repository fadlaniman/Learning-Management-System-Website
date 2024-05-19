@extends('layout.classes')
@section('data')
<div class="container-container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="info-box bg-info pt-5 pb-3">
                <div class="info-box-content">
                    <h3 class="info-box-text">{{$class->name}}</h3>
                    <h6 class="progress-description">
                        {{$class->description}}
                    </h6>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection