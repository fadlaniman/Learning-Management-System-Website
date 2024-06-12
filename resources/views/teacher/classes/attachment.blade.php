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
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Classes</li>
                        <li class="breadcrumb-item active">{{$attachments->class->id}}</li>
                        <li class="breadcrumb-item"><a href="#">{{$attachments->id}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="{{$attachments->type == 'assignment'?'bg-danger text-white rounded-circle mr-3' : 'bg-warning text-white rounded-circle mr-3'}}" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="{{$attachments->type == 'assignment'?'far fa-clipboard' : 'fas fa-book'}}" style="font-size: 24px;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $attachments->title }}</h4>
                                    <p class="text-muted mb-1 text-sm">{{ $attachments->users->firstName . ' ' . $attachments->users->lastName . ' . ' .  \Carbon\Carbon::parse($attachments->created_at)->format('d M')}}</p>
                                    <small class="text-muted"><span style="color: #333333;">{{ $attachments->score? $attachments->score . ' points' : '' }} </span></small>
                                </div>
                            </div>
                            <div class="dropdown ml-auto">
                                <button class="btn btn-link text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#editUserModal" data-toggle="modal">Edit</a>
                                    <a class="dropdown-item" href="#deleteUserModal" data-toggle="modal">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">
                                {{ $attachments->description }}
                            </p>
                            @if (pathinfo($attachments->file, PATHINFO_EXTENSION) == 'mp4')
                            <video width="100%" controls>
                                <source src="{{ asset('storage/' . $attachments->file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @else
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <a href="{{ asset('storage/' . $attachments->file) }}" target="_blank" class="d-block">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 p-0">
                                                    <img src="{{ asset('storage/' . $attachments->file) }}" class="img-fluid h-100" style="object-fit: cover;" alt="File Attachment">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <p class="card-text mb-1" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">{{ $attachments->file }}</p>
                                                        <small class="text-muted text-uppercase">{{ pathinfo($attachments->file, PATHINFO_EXTENSION) }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-end mb-3">
                                <div class="col-md-6 text-right">
                                    <a href="{{ asset('storage/' . $attachments->file) }}" class="btn btn-primary btn-sm" download><i class="fas fa-download mr-1"></i>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-primary text-white py-3">
                                    <h6 class="mb-0">Attachment Comments</h6>
                                </div>
                                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                    @foreach ($attachments->comments as $comment)
                                    <div class="media mt-3">
                                        <div class="media-body pl-3 pr-3">
                                            <h6 class="mt-0 mb-1 text-primary">{{ $comment->users->firstName . ' ' . $comment->users->lastName }}</h6>
                                            <p class="mb-1 text-muted">{{ $comment->text }}</p>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <!-- Garis pembatas -->
                                    <hr>
                                    @endforeach
                                </div>
                                <div class="card-footer bg-white py-3">
                                    <form id="commentForm" method="post" action="{{url('/teacher/classes/' . $attachments->class->id  . '/' . $attachments->id . '/store')}}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" id="commentInput" name="text" class="form-control rounded-pill border-0 shadow-sm" placeholder="Type your message..." aria-label="Type your message..." aria-describedby="button-send">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary rounded-pill" type="submit" id="button-send"><i class="fas fa-paper-plane"></i> </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    @endsection

    <!-- Edit Modal HTML -->
    <div id="editUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('/admin/user/' . $attachments . '/update')}}">
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
                            <input name="title" type="text" class="form-control">
                            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="{{$attachments->type == 'assignment'?'bg-danger text-white rounded-circle mr-3' : 'bg-warning text-white rounded-circle mr-3'}}" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <i class="{{$attachments->type == 'assignment'?'far fa-clipboard' : 'fas fa-book'}}" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0">{{ $attachments->title }}</h4>
                                        <p class="text-muted mb-1 text-sm">{{ $attachments->users->firstName . ' ' . $attachments->users->lastName . ' . ' .  \Carbon\Carbon::parse($attachments->created_at)->format('d M')}}</p>
                                        <small class="text-muted"><span style="color: #333333;">{{ $attachments->score }} points</span></small>
                                    </div>
                                </div>
                                <div class="dropdown ml-auto">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#editUserModal" data-toggle="modal">Edit</a>
                                        <a class="dropdown-item" href="#deleteUserModal" data-toggle="modal">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-muted">
                                    {{ $attachments->description }}
                                </p>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <a href="{{ asset('storage/' . $attachments->file) }}" target="_blank" class="d-block">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 p-0">
                                                        <img src="{{ asset('storage/' . $attachments->file) }}" class="img-fluid h-100" style="object-fit: cover;" alt="File Attachment">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <p class="card-text mb-1" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">{{ $attachments->file }}</p>
                                                            <small class="text-muted text-uppercase">{{ pathinfo($attachments->file, PATHINFO_EXTENSION) }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="card-footer bg-white border-top-0">
                                                <a href="{{ asset('storage/' . $attachments->file) }}" class="btn btn-primary btn-sm" download><i class="fas fa-download mr-1"></i>Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" class="form-control" value="{{$attachments}}" required></input>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input name="file" type="file" class="form-label"></input>
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

    <!-- Delete Modal HTML -->
    <div id="deleteUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('/teacher/classes/' . $attachments->class_id . '/'. $attachments->id  . '/delete')}}">
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