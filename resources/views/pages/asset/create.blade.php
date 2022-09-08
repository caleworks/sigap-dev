@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} &raquo; New</h1>
        </div>

        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('asset.store') }}" method="post">
                @csrf
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input {{ $title }} Data</h6>
                    <div>
                        <a href="{{ route('asset.index') }}" class="btn btn-secondary shadow-sm">Back</a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>
                <div class="card-body text-gray-900 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row m-3">
                                <label for="name" class="form-label">Asset Code</label>
                                <input type="text" name="asset_code" id="asset_code" class="form-control @error('asset_code') is-invalid @enderror" 
                                    placeholder="Example: fncltp01" value="{{ old('asset_code') }}" required>
                                @error('asset_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="name" class="form-label">Asset Name</label>
                                <input type="text" name="asset_name" id="asset_name" class="form-control @error('asset_name') is-invalid @enderror" 
                                    placeholder="Example: Asus A416EP" value="{{ old('asset_name') }}" required>
                                @error('asset_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="name" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" 
                                    id="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}" @if($category['id'] == old('category_id')) selected @endif>
                                            {{ $category['category'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="unit_id" class="form-label">Unit</label>
                                <select id="unit_id" name="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                    @foreach($units as $unit)
                                        <option value="{{ $unit['id'] }}" @if($unit['id'] == old('unit_id')) selected @endif>
                                            {{ $unit['unit'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="name" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" 
                                    rows="3">{{ old('notes') }}</textarea>
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