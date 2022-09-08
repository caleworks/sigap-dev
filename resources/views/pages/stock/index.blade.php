@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            <a href="{{ route('stock.create') }}" class="d-none d-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New {{ $title }}
            </a>
        </div>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Status</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Location</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Location</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->stock_code }}</td>
                                <td>{{ $stock->stock_name }}</td>
                                <td>{{ $stock->stockCategory()->first()->category }}</td>
                                <td>{{ $stock->stock }} {{ $stock->stockUnit()->first()->unit }}</td>
                                <td>{{ $stock->stored_at }}</td>
                                <td>{{ $stock->notes }}</td>
                                <td>
                                    <a href="{{ route('stock.edit', $stock->stock_code) }}" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('stock.destroy', $stock->id) }}" class="d-inline" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $stock->stock_name }}?')">
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

@endsection