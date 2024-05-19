@extends('layout.index')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
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
                      <th >
                        UID
                      </th>
                      <th >
                          Name
                      </th>
                      <th>
                          Email
                      </th>
                      <th>
                          Role
                      </th>
                      <th >Phone
                      </th>
                  </tr>
              </thead>
              <tbody>
              @foreach($users as $user)

                  <tr>
                      <td>
                          {{$user->uid}}
                      </td>
                      <td>
                      {{$user->firstName . ' ' . $user->lastName}}
                      </td>
                      <td>
                        {{$user->email}}
                      </td>
                      <td>
                        {{$user->role}}
                      </td>
                      <td>
                        {{$user->phone}}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="#editUserModal{{$user->uid}}" data-toggle="modal">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#deleteUserModal{{$user->uid}}" data-toggle="modal">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>

                @endforeach  
                {{ $users->links()}}
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
                <form method="post" action="{{url('/auth/register')}}">
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
                            <label>Password</label>
                            <input name="password" class="form-control" required></input>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="admin">admin</option>
                                <option value="teacher">teacher</option>
                                <option value="student">student</option>
                                <option value="parent">parent</option>
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
                            <label>Role</label>
                            <select name="role"  class="form-control"  required>
                                <option value="{{$user->role}}" selected>{{$user->role}}</option>
                                <option value="admin">admin</option>
                                <option value="teacher">teacher</option>
                                <option value="student">student</option>
                                <option value="parent">parent</option>
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

