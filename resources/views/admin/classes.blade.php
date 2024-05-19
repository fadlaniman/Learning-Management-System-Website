@extends('layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Users
                            </th>
                            <th>
                                Studies
                            </th>
                            <th>
                                Created
                            </th>
                            <th>
                                Update
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                        <tr>
                            <td>{{$class->id}}
                            </td>
                            <td>{{$class->user_id}}
                            </td>
                            <td>{{$class->class_id}}
                            </td>
                            <td>{{$class->created_at}}
                            </td>
                            <td>{{$class->updated_at}}
                            </td>
                
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="#editUserModal{{$class->id}}" data-toggle="modal">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#deleteUserModal{{$class->id}}" data-toggle="modal">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
        
                        @endforeach()
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- Insert Modal HTML -->
<div id="addUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/class')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Insert Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>User</label>
                        <select name="uid"  class="form-control" required>
                            @foreach($users as $user)
                            <option value="{{$user->uid}}">{{$user->uid}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Studies</label>
                        <select name="class_id" class="form-control" required>
                            @foreach($studies as $study)
                            <option value="{{$study->id}}">{{$study->id}}</option>
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
                        <select name="uid"  class="form-control" required>
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
@endsection
