@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            <a href="{{ route('asset.create') }}" class="d-none d-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New {{ $title }}
            </a>
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
                                <th>Asset Code</th>
                                <th>Asset Name</th>
                                <th>Category</th>
                                <th>Used Assets</th>
                                <th>Ready to Use</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Asset Code</th>
                                <th>Asset Name</th>
                                <th>Category</th>
                                <th>Used Assets</th>
                                <th>Ready to Use</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($assets as $item)
                            <tr>
                                <td>{{ $item->asset_code }}</td>
                                <td>{{ $item->asset_name }}</td>
                                <td>{{ $item->assetCategory()->first()->category }}</td>
                                <td>88 {{ $item->assetUnit()->first()->unit }}</td>
                                <td>88 {{ $item->assetUnit()->first()->unit }}</td>
                                <td>
                                    <a href="{{ route('asset.item.create', $item->asset_code) }}" class="btn btn-primary btn-circle btn-sm" title="Add New Asset Item">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ route('asset.show', $item['asset_code']) }}" class="btn btn-info btn-circle btn-sm" title="View Details">
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