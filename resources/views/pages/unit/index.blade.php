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
                        <h5 class="modal-title" id="addModal">Add New Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('unit.store') }}" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                <div class="row m-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" 
                                        placeholder="Unit" value="{{ old('unit') }}" required autofocus>
                                    @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
                                <th>Unit</th>
                                <th>Created date</th>
                                <th>Last update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Unit</th>
                                <th>Created date</th>
                                <th>Last update</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($units as $item)
                            <tr>
                                <td>{{ $item['unit'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>{{ $item['updated_at'] }}</td>
                                <td>
                                    <a href="{{ url('unit/'.$item['id'].'/edit') }}" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ url('unit/'.$item['id']) }}" class="d-inline" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $item['unit'] }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                    <h5 class="modal-title" id="editModal">Edit Unit</h5>
                    <a href="{{ url('unit') }}">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>
                </div>
                <form action="{{ route('unit.update', $unit->id ) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="justify-content-center">
                            <div class="row m-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" 
                                    placeholder="Unit" value="{{ old('unit', $unit->unit) }}" required autofocus>
                                @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @csrf
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="{{ url('unit') }}">Close</a>
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