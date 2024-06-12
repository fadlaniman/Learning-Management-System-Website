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
                        <li class="breadcrumb-item"><a href="#">Studies</a></li>
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
                <a href="#addclassModal" class="btn btn-success" data-toggle="modal"><i class="far fa-plus-square">&#xE147;</i> <span>Insert</span></a>
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $index => $class)
                        <tr>
                            <td>{{$index += 1}}</td>
                            <td>{{$class->id}}</td>
                            <td>{{$class->name}}</td>
                            <td>{{$class->description}}</td>
                            <td>{{$class->duration}}</td>
                            <td>{{$class->created_at}}</td>
                            <td>{{$class->updated_at}}</td>
                            <td class="project-actions">
                                <a class="btn btn-outline-primary btn-sm" href="#editClassModal{{$class->id}}" data-toggle="modal" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-outline-danger btn-sm" href="#deleteClassModal{{$class->id}}" data-toggle="modal" title="Delete">
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
    @endsection
    <!-- /.content -->
    <!-- Insert Modal HTML -->
    <div id="addclassModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('/admin/studies')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Insert Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Code</label>
                            <input name="id" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <select name="duration" class="form-control" required>
                                <option value="" selected>Selected Duration</option>
                                <option value="{{1}}">1</option>
                                <option value="{{2}}">2</option>
                                <option value="{{3}}">3</option>
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
    <div id="editclassModal{{$class->id}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('/admin/studies/'. $class->id . '/update')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input name="id" type="text" class="form-control" value="{{$class->id}}" required>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{$class->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" type="text" class="form-control" value="{{$class->description}}">
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <select name="duration" class="form-control" required>
                                <option value="{{$class->duration}}" selected>{{$class->duration}}</option>
                                <option value="{{1}}">1</option>
                                <option value="{{2}}">2</option>
                                <option value="{{3}}">3</option>
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
    <div id="deleteclassModal{{$class->id}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('/admin/studies/'. $class->id . '/delete')}}">
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