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
                                <th>No</th>
                                <th>Regist Number</th>
                                <th>Serial Number</th>
                                <th>Asset Name</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Regist Number</th>
                                <th>Serial Number</th>
                                <th>Asset Name</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @foreach ($productSpec as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['product_code'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{!! Str::limit($item['specification'], 25) !!}</td>
                                <td>{{ $item->productCategories()->first()->category }}</td>
                                <td>{{ $item['notes'] }}</td>
                                <td>
                                    <a href="{{ route('asset.product.show', $item['product_code']) }}" class="btn btn-info btn-circle btn-sm" title="View Details">
                                        <i class="fas fa-info"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection