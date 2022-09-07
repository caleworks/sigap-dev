@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Maintenance, Repair, and Operation Stock</h1>
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
                            @foreach ($mro_items as $mro_item)
                            <tr>
                                <td>{{ $mro_item->mro_code }}</td>
                                <td>{{ $mro_item->mro_name }}</td>
                                <td>{{ $mro_item->mroCategory()->first()->category }}</td>
                                <td>{{ $mro_item->stock }} {{ $mro_item->mroUnit()->first()->unit }}</td>
                                <td>{{ $mro_item->stored_at }}</td>
                                <td>{{ $mro_item->notes }}</td>
                                <td>
                                    <a href="{{ route('asset.item.create', $mro_item->mro_code) }}" class="btn btn-primary btn-circle btn-sm" title="Add New Asset Item">
                                        <i class="fas fa-arrow-up"></i>
                                    </a>
                                    <a href="{{ route('asset.show', $mro_item->mro_code) }}" class="btn btn-info btn-circle btn-sm" title="View Details">
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