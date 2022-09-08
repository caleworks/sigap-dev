@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} &raquo; {{ $assetDetail->asset_name }}</h1>
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
            <div class="card-body text-gray-900">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row m-3">
                            <ul class="list-unstyled mb-0">
                                <li class="small font-weight-bold">Asset Code</li>
                                <li class="mb-3">{{ $assetDetail->asset_code }}</li>
                                <li class="small font-weight-bold">Asset Name</li>
                                <li class="mb-3">{{ $assetDetail->asset_name }}</li>
                                <li class="small font-weight-bold">Category</li>
                                <li class="mb-3">{{ $assetDetail->assetCategory()->first()->category }}</li>
                                <li class="small font-weight-bold">Description</li>
                                <li class="mb-3">{{ $assetDetail->description ?? '-' }}</li>
                                <li class="small font-weight-bold">Notes</li>
                                <li class="">{{ $assetDetail->notes ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row p-3">
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Count of {{ $assetDetail->asset_name }} Item(s)</span>
                                <div class="h2">{{ $assetDetail->asset_items_count }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Ready Item(s)</span>
                                <div class="h2">{{ $assetDetail->readyItems }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Delivered Item(s)</span>
                                <div class="h2">{{ $assetDetail->deliveredItems }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Maintenance Item(s)</span>
                                <div class="h2">{{ $assetDetail->maintenanceItems }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Damaged/Broken Item(s)</span>
                                <div class="h2">{{ $assetDetail->brokenItems }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Other(s)</span>
                                <div class="h2">{{ $assetDetail->otherItems }} <small>{{ $assetDetail->assetUnit()->first()->unit }}</small></div>
                            </div>
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
                    <a href="{{ route('asset.item.create', $assetDetail->asset_code) }}" class="btn btn-sm btn-primary shadow-sm">Add New Asset Item</a>
                </div>
            </div>

            <!-- Asset List Content -->
            <div class="card-body text-gray-900">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Regist Number</th>
                                <th>Serial Number</th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Purchase Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Regist Number</th>
                                <th>Serial Number</th>
                                <th>User</th>
                                <th>Location</th>
                                <th>Purchase Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $asset->regist_number }}</td>
                                <td>{{ $asset->serial_number }}</td>
                                <td>{{ $asset->deliver_to ?? '-' }}</td>
                                <td>{{ $asset->location ?? '-' }}</td>
                                <td>{{ optional($asset->date_purchase)->format('d M Y') ?? '-' }}</td>
                                <td>{{ optional($asset->date_deliver)->format('d M Y') ?? '-' }}</td>
                                <td>{{ $asset->status ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('item.edit', $asset->regist_number) }}" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('item.destroy', $asset->regist_number) }}" class="d-inline" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $asset->regist_number ?? $asset->serial_number }}?')">
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