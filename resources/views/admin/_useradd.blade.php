@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User</h1>
            <a href="{{ url('user/add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add New User</a>
        </div>

        <!-- Content Row -->
        <div class="row text-gray-900">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCard">
                    <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCard">
                    <div class="card-body">
                        
                        <form action="{{ url('user/add') }}" method="post">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email :</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection