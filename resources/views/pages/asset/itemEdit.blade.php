@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit {{ $assetDetail->asset_name }} &raquo; {{ $assetItem->regist_number ?? $assetItem->serial_number }}</h1>
        </div>

        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('asset.item.store', $assetDetail->asset_code) }}" method="post">
                @csrf
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
                                    <li class="mb-3">{{ $assetDetail->description }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 font-weight-bold">
                            <div class="row m-3">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" 
                                    placeholder="" value="{{ old('serial_number', $assetItem->serial_number) }}" disabled>
                                @error('serial_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                                <label for="deliver_to" class="form-label">User</label>
                                <input type="text" name="deliver_to" id="deliver_to" class="form-control @error('deliver_to') is-invalid @enderror" 
                                    placeholder="" value="{{ old('deliver_to', $assetItem->deliver_to) }}">
                                @error('deliver_to')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" 
                                    placeholder="" value="{{ old('location', $assetItem->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-1">
                                <div class="col-md-4">
                                    <label for="date_purchase" class="form-label">Purchase Date</label>
                                    <input type="text" name="date_purchase" id='datetimepicker4' class="form-control @error('date_purchase') is-invalid @enderror" 
                                        placeholder="" value="{{ old('date_purchase', $assetItem->date_purchase->format('Y-m-d')) }}">
                                    @error('date_purchase')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="date_deliver" class="form-label">Delivery Date</label>
                                    <input type="text" name="date_deliver" id="location" class="form-control @error('date_deliver') is-invalid @enderror" 
                                        placeholder="" value="{{ old('date_deliver', $assetItem->date_deliver->format('Y-m-d')) }}">
                                    @error('date_deliver')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="upload_bast" class="form-label">Upload BAST</label>
                                    <input type="file" name="files" id="upload_bast" accept="application/pdf" class="form-control @error('upload_bast') is-invalid @enderror" 
                                        placeholder="Upload File"" value="{{ old('upload_bast') }}" disabled>
                                    @error('upload_bast')
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

    </div>
    <!-- /.container-fluid -->

@endsection