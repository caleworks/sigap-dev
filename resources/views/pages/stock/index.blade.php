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
                                <th>Fix Stock</th>
                                <th>Stock</th>
                                <th>Max Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Category</th>
                                <th>Fix Stock</th>
                                <th>Stock</th>
                                <th>Max Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->stock_code }}</td>
                                <td>{{ $stock->stock_name }}</td>
                                <td>{{ $stock->stockCategory()->first()->category }}</td>
                                <td>{{ $stock->fix_stock }} {{ $stock->stockUnit()->first()->unit }}</td>
                                <td>{{ $stock->stock }} {{ $stock->stockUnit()->first()->unit }}</td>
                                <td>{{ $stock->max_stock }} {{ $stock->stockUnit()->first()->unit }}</td>
                                <td>
                                    @if ($stock->stock>$stock->max_stock)
                                    <span class="badge badge-warning" title="Exceeds Max Stock">> Max Stock</span>
                                    @elseif ($stock->stock<$stock->fix_stock)
                                    <span class="badge badge-danger" title="Stock is less than Fix Stock">< Fix Stock</span>
                                    @else
                                    <span class="badge badge-success" title="Available">On Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('stock.show', $stock->stock_code) }}" class="btn btn-info btn-circle btn-sm" title="View Details">
                                        <i class="fas fa-info"></i>
                                    </a>
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