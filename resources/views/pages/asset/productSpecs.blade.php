@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            <!-- Button trigger modal -->
            <button type="button" class="d-none d-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New {{ $title }}
            </button>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content text-gray-900">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Add New Product Specification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form action="{{ route('asset.product.store') }}" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                <div class="row m-3">
                                    <label for="name" class="form-label">Product Code</label>
                                    <input type="text" name="product_code" id="product_code" class="form-control @error('product_code') is-invalid @enderror" 
                                        placeholder="Example: fncltp01" value="{{ old('product_code') }}" required>
                                    @error('product_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Example: Asus A416EP" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="name" class="form-label">Specification</label>
                                    <textarea class="form-control @error('specification') is-invalid @enderror" name="specification" 
                                        id="specification" rows="3">{{ old('specification') }}</textarea>
                                    @error('specification')
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
                                @csrf
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <!-- End of Modal Form -->
                    
                </div>
            </div>
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
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Specification</th>
                                <th>Category</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Specification</th>
                                <th>Category</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($productSpec as $item)
                            <tr>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection