@extends('layout.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ul class="nav nav-tabs border-0" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active rounded-0 d-flex align-items-center" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">
                                <i class="fas fa-check-circle mr-2"></i> Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-0 d-flex align-items-center" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">
                                <i class="fas fa-book mr-2"></i> Classwork
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded-0 d-flex align-items-center" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">
                                <i class="fas fa-users mr-2"></i> People
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Classes</li>
                        <li class="breadcrumb-item"><a href="#">{{$classes->id}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    @yield('attendance')
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    @yield('classwork')
                </div>
                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                    @yield('people')
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <!-- Insert Modal HTML -->
    <div id="addMaterialModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="{{url('/teacher/classes/' . $classes->id . '/detail')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Insert Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control" required>
                                <option value="material" selected>material</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input name="file" class="form-control" type="file" class="form-label"></input>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Insert Modal HTML -->
    <div id="addAssignmentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="{{url('/teacher/classes/' . $classes->id . '/detail')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Insert Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input name="file" class="form-control" type="file" class="form-label"></input>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-control" required>
                                <option value="assignment" selected>assignment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input name="deadline" class="form-control" type="datetime-local"></input>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal HTML -->
@foreach($classes->attachments as $attachment)
<div id="editUserModal{{$attachment->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/teacher/classes/' . $classes->id . '/'. $attachment->id  . '/update')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" value="{{$attachment->title}}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" required>{{$attachment->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input name="file" class="form-control" type="file" class="form-label"></input>
                    </div>
                    @if ($attachment->type == 'assignment')
                    <div class="form-group">
                        <label>Score</label>
                        <input name="score" class="form-control" type="number" value="{{$attachment->score}}"></input>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control" required>
                            <option value="{{$attachment->type}}" selected>{{$attachment->type}}</option>
                        </select>
                    </div>
                    @if ($attachment->type == 'assignment')
                    <div class="form-group">
                        <label>Deadline</label>
                        <input name="deadline" class="form-control" type="datetime-local" value="{{$attachment->deadline}}"></input>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Modal HTML -->
@foreach($classes->attachments as $attachment)
<div id="deleteUserModal{{$attachment->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/teacher/classes/' . $classes->id. '/'. $attachment->id  . '/delete')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection