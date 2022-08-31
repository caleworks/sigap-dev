@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} Detail</h1>
        </div>
        
        <!-- Main Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Data Detail</h6>
                <div>
                    <a href="{{ route('asset.index') }}" class="btn btn-secondary shadow-sm">Back</a>
                    <a href="{{ route('asset.edit', $assetDetail->asset_code) }}" class="btn btn-primary shadow-sm">Edit</a>
                    <form action="{{ route('asset.destroy', $assetDetail->id) }}" class="d-inline" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger shadow-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $assetDetail->asset_name }}?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Asset Detail Content -->
            <div class="card-body text-gray-900 font-weight-bold">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-4 col-lg-2">Asset Code</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->asset_code }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Asset Name</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->asset_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Description</div> : 
                            <div class="col font-weight-normal m-0">{!! $assetDetail->description !!}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Category</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->assetCategory()->first()->category }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Unit</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->assetUnit()->first()->unit }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Last Update</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->updated_at->format('d M Y H:i') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Date Created</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->created_at->format('d M Y H:i') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Notes</div> : 
                            <div class="col font-weight-normal">{{ $assetDetail->notes }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Asset Item</h6>
                <div>
                    <a href="{{ route('asset.edit', $assetDetail->asset_code) }}" class="btn btn-sm btn-primary shadow-sm">Add New Asset Item</a>
                </div>
            </div>

            <!-- Asset List Content -->
            <div class="card-body text-gray-900 font-weight-bold">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Regist Number</th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Serial Number</th>
                                <th>Regist Number</th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @foreach ($assets as $item)
                            <tr>
                                <td>{{ $item['asset_code'] }}</td>
                                <td>{{ $item['asset_name'] }}</td>
                                <td>{{ $item->assetCategory()->first()->category }}</td>
                                <td>88 {{ $item->assetUnit()->first()->unit }}</td>
                                <td>88 {{ $item->assetUnit()->first()->unit }}</td>
                                <td>
                                    <a href="{{ route('asset.create') }}" class="btn btn-primary btn-circle btn-sm" title="Add New Asset Item">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ route('asset.show', $item['asset_code']) }}" class="btn btn-info btn-circle btn-sm" title="View Details">
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