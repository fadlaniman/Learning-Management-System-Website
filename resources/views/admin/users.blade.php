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
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
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
                            <th>Email</th>
                            <th>Level</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{$index += 1}}</td>
                            <td>{{$user->uid}}</td>
                            <td>{{$user->firstName . ' ' . $user->lastName}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->level}}</td>
                            <td>{{$user->phone}}</td>
                            <td class="project-actions">
                                <a class="btn btn-outline-primary btn-sm" href="#editUserModal{{$user->uid}}" data-toggle="modal" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-outline-danger btn-sm" href="#deleteUserModal{{$user->uid}}" data-toggle="modal" title="Delete">
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
        <div class="container-fluid mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="{{$users->previousPageUrl()}}">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @for ($count = 1; $count <= $users->lastPage(); $count++)
                        <li class="page-item {{$users->currentPage()? 'active' : ''}}"><a class="page-link" href="#">{{$count}}</a></li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="{{$users->nextPageUrl()}}">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                </ul>
            </nav>
        </div>
        <!-- /.card -->
</div>

</section>
@endsection
<!-- /.content -->

<!-- Insert Modal HTML -->
<div id="addUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/users')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Insert Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>UID</label>
                        <input name="uid" type="text" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>First Name</label>
                            <input name="firstName" type="text" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label>Last Name</label>
                            <input name="lastName" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>level</label>
                        <select name="level" class="form-control" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="text" class="form-control">
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
@foreach($users as $user)
<div id="editUserModal{{$user->uid}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/user/' . $user->uid . '/update')}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col">
                            <label>First Name</label>
                            <input name="firstName" type="text" class="form-control" value="{{$user->firstName}}" required>
                        </div>
                        <div class="form-group col">
                            <label>Last Name</label>
                            <input name="lastName" type="text" class="form-control" value="{{$user->lastName}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" value="{{$user->email}}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required>
                            <option value="{{$user->level}}" selected>{{$user->level}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="text" class="form-control" value="{{$user->phone}}">
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
@foreach($users as $user)
<div id="deleteUserModal{{$user->uid}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('/admin/user/' . $user->uid . '/delete')}}">
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