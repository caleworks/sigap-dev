@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New {{ $title }}</h1>
        </div>

        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('asset.create') }}" method="post">
                @csrf
                @method('put')
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
                            <div class="form-group row">
                                <label for="product_code" class="col-4 col-lg-3 col-form-label">Product Spec Code</label>
                                <div class="col">
                                    <input type="text" name="product_code" id="product_code" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code', $_GET['product_code'] ?? '') }}" required>
                                    @error('product_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="serial_number" class="col-4 col-lg-3 col-form-label">Serial Number</label>
                                <div class="col">
                                    <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}" required>
                                    @error('serial_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="regist_number" class="col-4 col-lg-3 col-form-label">Regist Number</label>
                                <div class="col">
                                    <input type="text" name="regist_number" id="regist_number" class="form-control @error('regist_number') is-invalid @enderror" value="{{ old('regist_number') }}" required>
                                    @error('regist_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="col-4 col-lg-3 col-form-label">Location</label>
                                <div class="col">
                                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                                    @error('location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection