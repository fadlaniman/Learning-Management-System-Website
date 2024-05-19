@extends('layout.index')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-flid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Class</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Class</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-flid -->
    </section>

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
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                Code
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Tingkatan
                            </th>
                            <th>
                                Durasi
                            </th>
                            <th>
                                Kapasitas
                            </th>
                            <th>
                                Created
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                        <tr>
                            <td>{{$class->id}}</td>
                            <td>{{$class->name}}</td>
                            <td>{{$class->description}}</td>
                            <td>{{$class->tingkatan}}</td>
                            <td>{{$class->durasi}}</td>
                            <td>{{$class->total}}</td>
                            <td>{{$class->created_at}}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="#editclassModal{{$class->id}}" data-toggle="modal">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#deleteclassModal{{$class->id}}" data-toggle="modal">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
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

    </section>
    <!-- /.content -->
</div>

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
                        <label>Tingkatan</label>
                        <input name="tingkatan" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input name="durasi" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input name="total" class="form-control" required></input>
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
                        <label>Tingkatan</label>
                        <input name="tingkatan" type="text" class="form-control" value="{{$class->tingkatan}}" required>
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input name="durasi" type="text" class="form-control" value="{{$class->durasi}}" required>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input name="total" type="number" class="form-control" value="{{$class->durasi}}" required>
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