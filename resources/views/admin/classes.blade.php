@extends('layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active" aria-current="page"></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        <li class="breadcrumb-item"><a href="#">Classes</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="far fa-plus-square">&#xE147;</i> <span>Insert</span></a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Studies</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $index => $class)
                        <tr>
                            <td>{{$index+=1}}</td>
                            <td>{{$class->users->uid}}</td>
                            <td>{{$class->users->firstName}} {{$class->users->lastName}}</td>
                            <td>{{$class->classes->id}} - {{$class->classes->name}}</td>
                            <td>{{$class->created_at}}</td>
                            <td>{{$class->updated_at}}</td>
                            <td class="project-actions">
                                <a class="btn btn-sm btn-outline-danger" href="#deleteUserModal{{$class->id}}" data-toggle="modal" title="Delete">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="container-fluid mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="{{$classes->previousPageUrl()}}">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @for ($count = 1; $count <= $classes->lastPage(); $count++)
                        <li class="page-item {{$classes->currentPage()? 'active' : ''}}"><a class="page-link" href="#">{{$count}}</a></li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="{{$classes->nextPageUrl()}}">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                </ul>
            </nav>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

<!-- Insert Modal HTML -->
<div id="addUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/classes')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Insert Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <select name="uid" class="form-control" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{$user->uid}}">{{$user->uid}} - {{$user->firstName}} {{$user->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Studies</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach($studies as $study)
                            <option value="{{$study->id}}">{{$study->id}} - {{$study->name}}</option>
                            @endforeach
                        </select>
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

<!-- Edit Modal HTML -->
@foreach($classes as $class)
<div id="editUserModal{{$class->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/class/'. $class->id . '/update')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <select name="uid" class="form-control" required>
                            @foreach($users as $user)
                            <option value="{{$user->uid}}">{{$user->uid}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Studies</label>
                        <select name="class_id" class="form-control" required>
                            @foreach($studies as $study)
                            <option value="{{$study->id}}" selected>{{$study->id}}</option>
                            <option value="{{$study->id}}">{{$study->id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Modal HTML -->
@foreach($classes as $class)
<div id="deleteUserModal{{$class->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/class/'. $class->id . '/delete')}}">
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
<!-- /.content-wrapper -->