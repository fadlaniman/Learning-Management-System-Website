@extends('layout.teacher.detail')
<!-- Classwork section -->

@section('attendance')

<div class="container mt-5">
    <h2 class="mb-4">List Absensi</h2>
    <ul class="list-group">
        @foreach ($attendances as $attendance)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$attendance->user_id}}
            <span class="badge bg-success">Hadir</span>
        </li>
        @endforeach
        <!-- Tambahkan item lainnya sesuai kebutuhan -->
    </ul>
</div>

@endsection
@section('classwork')
<div class="card-header text-white py-3">
    <div class="dropdown">
        <button class="btn btn-success btn-sm py-2 px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus-circle mr-2"></i> Create
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#addMaterialModal" data-toggle="modal">Material</a>
            <a class="dropdown-item" href="#addAssignmentModal" data-toggle="modal">Assignment</a>
            <!-- Tambahkan opsi dropdown lainnya di sini sesuai kebutuhan -->
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 p-4">
        @if ($classes->attachments->where('type', 'material')->isNotEmpty())
        <!-- Materials Section -->
        <h5 class="mb-3">Materials</h5>
        <div class="row">
            @foreach ($classes->attachments as $attachment)
            @if ($attachment->type == 'material')
            <div class="col-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning"><i class="fa fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text font-weight-bold">{{ $attachment->title }}</span>
                        <span class="info-box-text text-sm">{{ $attachment->description }}</span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="dropdown">
                        <button class="btn btn-link text-dark" type="button" id="dropdownMenuButton{{ $attachment->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $attachment->id }}">
                            <a class="dropdown-item" href="/teacher/classes/{{ $classes->id }}/{{ $attachment->id }}/detail">
                                <i class="fas fa-eye me-2 text-primary"></i> View
                            </a>
                            <a class="dropdown-item" href="#editUserModal{{ $attachment->id }}" data-toggle="modal">
                                <i class="fas fa-edit me-2 text-warning"></i> Edit
                            </a>
                            <a class="dropdown-item" href="#deleteUserModal{{ $attachment->id }}" data-toggle="modal">
                                <i class="fas fa-trash-alt me-2 text-danger"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
        @if ($classes->attachments->where('type', 'assignment')->isNotEmpty())
        <!-- Assignments Section -->
        <h5 class="mb-3">Assignments</h5>
        <div class="row">
            @foreach ($classes->attachments as $attachment)
            @if ($attachment->type == 'assignment')
            <div class="col-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger"><i class="far fa-clipboard"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text font-weight-bold">{{ $attachment->title }}</span>
                        <span class="info-box-text text-sm">{{ $attachment->description }}</span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="dropdown">
                        <button class="btn btn-link text-dark" type="button" id="dropdownMenuButton{{ $attachment->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $attachment->id }}">
                            <a class="dropdown-item" href="/teacher/classes/{{ $classes->id }}/{{ $attachment->id }}/detail">
                                <i class="fas fa-eye me-2 text-primary"></i> View
                            </a>
                            <a class="dropdown-item" href="#editUserModal{{ $attachment->id }}" data-toggle="modal">
                                <i class="fas fa-edit me-2 text-warning"></i> Edit
                            </a>
                            <a class="dropdown-item" href="#deleteUserModal{{ $attachment->id }}" data-toggle="modal">
                                <i class="fas fa-trash-alt me-2 text-danger"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection

@section('people')
<!-- People section -->
<!-- Teachers Section -->
@if ($classes->users->where('level', '2')->isNotEmpty())
<div class="row mt-3">
    <div class="col-12">
        <h5 class="mb-3">Teachers</h5>
    </div>
    @foreach ($classes->users as $attachment)
    @if ($attachment->level == '2')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text font-weight-bold">{{ $attachment->firstName . ' ' . $attachment->lastName }}</span>
                <span class="info-box-text text-sm">teacher</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    @endif
    @endforeach
</div>
@endif
<!-- Students Section -->
@if ($classes->users->where('level', '3')->isNotEmpty())
<div class="row mt-3">
    <div class="col-12">
        <h5 class="mb-3">Students</h5>
    </div>
    @foreach ($classes->users as $attachment)
    @if ($attachment->level == '3')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text font-weight-bold">{{ $attachment->firstName . ' ' . $attachment->lastName }}</span>
                <span class="info-box-text text-sm">student</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    @endif
    @endforeach
</div>
@endif
</div>
@endsection