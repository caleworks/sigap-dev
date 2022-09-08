@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} &raquo; {{ $assetDetail->asset_name }} &raquo; {{ $assetItem->regist_number ?? $assetItem->serial_number }} &raquo; Edit</h1>
        </div>

        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('item.update', $assetItem->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('put')
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Asset Item {{ $assetItem->regist_number ?? $assetItem->serial_number }}</h6>
                    <div>
                        <a href="{{ route('asset.show', $assetDetail->asset_code) }}" class="btn btn-secondary shadow-sm">Back</a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>
                <div class="card-body text-gray-900">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row m-3">
                                <ul class="list-unstyled mb-3">
                                    <li class="small font-weight-bold">Asset Code</li>
                                    <li class="mb-3">{{ $assetDetail->asset_code }}</li>
                                    <li class="small font-weight-bold">Asset Name</li>
                                    <li class="mb-3">{{ $assetDetail->asset_name }}</li>
                                    <li class="small font-weight-bold">Category</li>
                                    <li class="mb-3">{{ $assetDetail->assetCategory()->first()->category }}</li>
                                    <li class="small font-weight-bold">Description</li>
                                    <li class="mb-3">{{ $assetDetail->description ?? '-' }}</li>
                                    <li class="small font-weight-bold">Notes</li>
                                    <li class="mb-3">{{ $assetDetail->notes ?? '-' }}</li>
                                </ul>
                                @if ($assetItem->scan_bast != NULL)
                                <div class="col-xl-12 px-0">
                                    <div class="card shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        PDF BAST</div>
                                                    <div class="mb-0 font-weight-bold">
                                                        <a class="text-decoration-none text-gray-900" href="{{ Storage::url($assetItem->scan_bast) }}" title="Open File">
                                                            {{ $assetItem->regist_number }}.pdf
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" title="Delete BAST" data-toggle="modal" data-target="#deleteModal">
                                                        <i class="fas fa-trash fa-2x text-gray-300"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9 font-weight-bold">
                            <div class="row m-3">
                                <label for="regist_number" class="form-label">Regist Number</label>
                                <input type="text" name="regist_number" id="regist_number" class="form-control @error('regist_number') is-invalid @enderror" 
                                placeholder="" value="{{ old('regist_number', $assetItem->regist_number) }}" disabled>
                                @error('regist_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" 
                                    placeholder="" value="{{ old('serial_number', $assetItem->serial_number) }}">
                                @error('serial_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mx-1 mb-3">
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="ready" @if(old('status', $assetItem->status) == "ready") selected @endif>
                                            Ready
                                        </option>
                                        <option value="delivered" @if(old('status', $assetItem->status) == "delivered") selected @endif>
                                            Delivered
                                        </option>
                                        <option value="maintenance" @if(old('status', $assetItem->status) == "maintenance") selected @endif>
                                            Maintenance
                                        </option>
                                        <option value="broken" @if(old('status', $assetItem->status) == "broken") selected @endif>
                                            Damaged/Broken
                                        </option>
                                        <option value="other" @if(old('status', $assetItem->status) == "other") selected @endif>
                                            Other
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="deliver_to" class="form-label">User</label>
                                    <input type="text" name="deliver_to" id="deliver_to" class="form-control @error('deliver_to') is-invalid @enderror" 
                                        placeholder="" value="{{ old('deliver_to', $assetItem->deliver_to) }}">
                                    @error('deliver_to')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" 
                                        placeholder="" value="{{ old('location', $assetItem->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-1">
                                <div class="col-md-4">
                                    <label for="date_purchase" class="form-label">Purchase Date</label>
                                    <input type="text" name="date_purchase" id='datetimepicker4' class="form-control @error('date_purchase') is-invalid @enderror" 
                                        placeholder="YYYY-MM-DD" value="{{ old('date_purchase', optional($assetItem->date_purchase)->format('Y-m-d')) }}">
                                    @error('date_purchase')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="date_deliver" class="form-label">Delivery Date</label>
                                    <input type="text" name="date_deliver" id="location" class="form-control @error('date_deliver') is-invalid @enderror" 
                                        placeholder="YYYY-MM-DD" value="{{ old('date_deliver', optional($assetItem->date_deliver)->format('Y-m-d')) }}">
                                    @error('date_deliver')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="files" class="form-label">Upload BAST</label>
                                    <input type="file" name="files" id="files" accept="application/pdf" class="form-control @error('files') is-invalid @enderror" 
                                        placeholder="Upload File"" value="{{ old('files') }}">
                                    @error('files')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" 
                                    rows="3">{{ old('notes', $assetItem->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if ($assetItem->scan_bast != NULL)
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-gray-900">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Delete {{ $assetItem->regist_number }}.pdf</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('delete_pdf', $assetItem->id) }}" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                @csrf
                                @method('patch')
                                Are you sure to delete this BAST file?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- /.container-fluid -->

@endsection