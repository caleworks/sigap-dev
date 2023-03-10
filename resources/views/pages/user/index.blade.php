@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            <!-- Button trigger modal -->
            <button type="button" class="d-none d-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New {{ $title }}
            </button>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-gray-900">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('user') }}" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                <div class="row m-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type New Password" value="{{ old('password') }}" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype Entered Password" value="{{ old('password_confirmation') }}" required>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="0">User</option>
                                        <option value="1">Administrator</option>
                                    </select>
                                </div>
                                @csrf
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Data</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last update</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>
                                @if ( $item['role'] == 1 )
                                    Administrator    
                                @elseif ( $item['role'] == 0 ) 
                                    User
                                @endif
                                </td>
                                <td>
                                @if ( $item['is_active'] == 1 )
                                    Active    
                                @elseif ( $item['is_active'] == 0 ) 
                                    Disabled
                                @endif
                                </td>
                                <td>{{ $item['updated_at'] }}</td>
                                <td>
                                    <a href="{{ url('user/'.$item['id'].'/edit') }}" class="btn btn-warning btn-circle btn-sm" title="Reset Password">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    @if ( $item['is_active'] == 1 )
                                    <form action="{{ url('user/'.$item['id'].'/disable') }}" method="post" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Disable" onclick="return confirm('Are you sure to disable {{ $item['name'] }}?')">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                    @elseif ( $item['is_active'] == 0 ) 
                                    <form action="{{ url('user/'.$item['id'].'/enable') }}" method="post" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-circle btn-sm" title="Enable" onclick="return confirm('Are you sure to enable {{ $item['name'] }}?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    {{-- Edit Page --}}
    @isset($edit)

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-gray-900">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Edit User</h5>
                    <a href="{{ url('user') }}">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>
                </div>
                <form action="{{ route('user.update', $user->id ) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                        <div class="justify-content-center">
                            <div class="row m-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Full Name" value="{{ $user->name }}" disabled>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $user->email }}" disabled>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave it blank if you don't want to reset the password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype Entered Password" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="0">User</option>
                                    <option value="1" @if ( $user->role == 1 ) selected @endif>Administrator</option>
                                </select>
                            </div>
                            @csrf
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="{{ url('user') }}">Close</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.Edit Modal -->

    @endisset
    {{-- /.Edit Page --}}

@endsection