@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} &raquo; {{ $stockDetail->stock_name }} &raquo; Edit</h1>
        </div>

        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('stock.update', $stockDetail->id) }}" method="post">
                @csrf
                @method('put')
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit {{ $title }} Data</h6>
                    <div>
                        <a href="{{ route('stock.index') }}" class="btn btn-secondary shadow-sm">Back</a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>
                <div class="card-body text-gray-900 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row mx-1 mb-3">
                                <div class="col-md-3">
                                    <label for="stock_code" class="form-label">Stock Code</label>
                                    <input type="text" name="stock_code" id="stock_code" class="form-control @error('stock_code') is-invalid @enderror" 
                                        placeholder="" value="{{ old('stock_code', $stockDetail->stock_code) }}">
                                    @error('stock_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-9">
                                    <label for="stock_name" class="form-label">Stock Name</label>
                                    <input type="text" name="stock_name" id="stock_name" class="form-control @error('stock_name') is-invalid @enderror" 
                                        placeholder="" value="{{ old('stock_name', $stockDetail->stock_name) }}">
                                    @error('stock_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}" @if($category['id'] == old('category_id', $stockDetail->category_id)) selected @endif>
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
                            <div class="row mx-1 mb-3">
                                <div class="col-md-4">
                                    <label for="fix_stock" class="form-label">Fix Stock</label>
                                    <input type="text" name="fix_stock" id="fix_stock" class="form-control @error('fix_stock') is-invalid @enderror" 
                                        placeholder="" value="{{ old('fix_stock', $stockDetail->fix_stock) }}">
                                    @error('fix_stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="max_stock" class="form-label">Max Stock</label>
                                    <input type="text" name="max_stock" id="max_stock" class="form-control @error('max_stock') is-invalid @enderror" 
                                        placeholder="" value="{{ old('max_stock', $stockDetail->max_stock) }}">
                                    @error('max_stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="unit_id" class="form-label">Unit</label>
                                    <select id="unit_id" name="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit['id'] }}" @if($unit['id'] == old('unit_id', $stockDetail->unit_id)) selected @endif>
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
                            </div>
                            <div class="row m-3">
                                <label for="stored_at" class="form-label">Stored at</label>
                                <input type="text" name="stored_at" id="stored_at" class="form-control @error('stored_at') is-invalid @enderror" 
                                    placeholder="" value="{{ old('stored_at', $stockDetail->stored_at) }}">
                                @error('stored_at')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row m-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" 
                                    rows="3">{{ old('notes', $stockDetail->notes) }}</textarea>
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