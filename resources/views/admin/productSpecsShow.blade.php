@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} Detail</h1>
        </div>
        
        {{-- View Only Content --}}
        @if(!isset($edit))
        <!-- Main Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Data Detail</h6>
                <div>
                    <a href="{{ route('asset.product.index') }}" class="btn btn-secondary shadow-sm">Back</a>
                    <a href="{{ route('asset.product.edit', $productDetail->product_code) }}" class="btn btn-primary shadow-sm">Edit</a>
                    <form action="{{ route('asset.product.destroy', $productDetail->id) }}" class="d-inline" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger shadow-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $productDetail->name }}?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Detail Content -->
            <div class="card-body text-gray-900 font-weight-bold">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-4 col-lg-2">Product Code</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->product_code }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Product Name</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Specification</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->specification }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Company</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->productCompanies()->first()->company_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Category</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->productCategories()->first()->category }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Unit</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->productUnits()->first()->unit }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Last Update</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->updated_at }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Date Created</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->created_at }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-2">Notes</div> : 
                            <div class="col font-weight-normal">{{ $productDetail->notes }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Asset List</h6>
            </div>

            <!-- Product Detail Content -->
            <div class="card-body text-gray-900 font-weight-bold">
                <div class="row">

                </div>
            </div>
        </div>
        @endif


        {{-- Edit Content --}}
        @if(isset($edit))
        <!-- Main Content -->
        <div class="card shadow mb-4">
            <form action="{{ route('asset.product.update', $productDetail->id ) }}" method="post">
                @csrf
                @method('put')
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Data Detail</h6>
                    <div>
                        <a href="{{ route('asset.product.show', $productDetail->product_code) }}" class="btn btn-secondary shadow-sm">Back</a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>
                <div class="card-body text-gray-900 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label for="product_code" class="col-4 col-lg-2 col-form-label">Product Code</label>
                                <div class="col">
                                    <input type="text" name="product_code" id="product_code" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code', $productDetail->product_code) }}" required>
                                    @error('product_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-4 col-lg-2 col-form-label">Product Name</label>
                                <div class="col">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $productDetail->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specification" class="col-4 col-lg-2 col-form-label">Specification</label>
                                <div class="col">
                                    <textarea class="form-control @error('specification') is-invalid @enderror" name="specification" id="specification" cols="30" rows="5">{{ old('specification', $productDetail->specification) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_id" class="col-4 col-lg-2 col-form-label">Company</label>
                                <div class="col">
                                    <input type="text" name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror" value="{{ $productDetail->company_name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category_id" class="col-4 col-lg-2 col-form-label">Category</label>
                                <div class="col">
                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" @if($category['id'] == old('category_id', $productDetail->category_id)) selected @endif>
                                                {{ $category['category'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_id" class="col-4 col-lg-2 col-form-label">Unit</label>
                                <div class="col">
                                    <select id="unit_id" name="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit['id'] }}" @if($unit['id'] == old('unit_id', $productDetail->unit_id)) selected @endif>
                                                {{ $unit['unit'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="notes" class="col-4 col-lg-2 col-form-label">Notes</label>
                                <div class="col">
                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="30" rows="5">{{ old('notes', $productDetail->notes) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif

    </div>
    <!-- /.container-fluid -->

@endsection