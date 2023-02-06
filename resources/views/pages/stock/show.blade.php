@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }} &raquo; {{ $stockDetail->stock_name }}</h1>
        </div>
        
        <!-- Main Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Data Detail</h6>
                <div>
                    <a href="{{ route('stock.index') }}" class="btn btn-secondary shadow-sm">Back</a>
                    <a href="{{ route('stock.edit', $stockDetail->stock_code) }}" class="btn btn-primary shadow-sm">Edit</a>
                    <form action="{{ route('stock.destroy', $stockDetail->id) }}" class="d-inline" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger shadow-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $stockDetail->stock_name }}?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stock Detail Content -->
            <div class="card-body text-gray-900">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row m-3">
                            <ul class="list-unstyled mb-0">
                                <li class="small font-weight-bold">Stock Code</li>
                                <li class="mb-3">{{ $stockDetail->stock_code }}</li>
                                <li class="small font-weight-bold">Stock Name</li>
                                <li class="mb-3">{{ $stockDetail->stock_name }}</li>
                                <li class="small font-weight-bold">Category</li>
                                <li class="mb-3">{{ $stockDetail->stockCategory()->first()->category }}</li>
                                <li class="small font-weight-bold">Location</li>
                                <li class="mb-3">{{ $stockDetail->stored_at ?? '-' }}</li>
                                <li class="small font-weight-bold">Notes</li>
                                <li class="">{{ $stockDetail->notes ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row p-3">
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Current Stock</span>
                                @if ($stockDetail->stock > $stockDetail->max_stock)
                                <span class="badge badge-warning" title="Exceeds Max Stock">> Max Stock</span>
                                @elseif ($stockDetail->stock < $stockDetail->fix_stock)
                                <span class="badge badge-danger" title="Stock is less than Fix Stock">< Fix Stock</span>
                                @else
                                <span class="badge badge-success" title="Available">On Stock</span>
                                @endif
                                <div class="h2">{{ $stockDetail->stock }} <small>{{ $stockDetail->stockUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Fix Stock</span>
                                <div class="h2">{{ $stockDetail->fix_stock }} <small>{{ $stockDetail->stockUnit()->first()->unit }}</small></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <span class="small font-weight-bold">Max Stock</span>
                                <div class="h2">{{ $stockDetail->max_stock }} <small>{{ $stockDetail->stockUnit()->first()->unit }}</small></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Content -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
                <div>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#restockModal">
                        <i class="fas fa-arrow-right-to-bracket fa-sm"></i> Restock
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#stockOutModal">
                        <i class="fas fa-arrow-up-from-bracket fa-sm"></i> Stock Out
                    </button>
                </div>
            </div>

            <!-- Stock List Content -->
            <div class="card-body text-gray-900">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Code</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Receipent</th>
                                <th>Notes</th>
                                <th>Receipt</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Code</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Receipent</th>
                                <th>Notes</th>
                                <th>Receipt</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ optional($transaction->created_at)->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>
                                    @if ($transaction->receipent != NULL)
                                        Stock Out
                                    @else
                                        Restock
                                    @endif
                                </td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->receipent }}</td>
                                <td>{{ $transaction->notes ?? '-' }}</td>
                                <td>@isset($transaction->receipt)
                                    <a href="{{ Storage::url($transaction->receipt) }}" target="_blank" rel="noopener noreferrer">Files</a> 
                                @endisset</td>
                                <td>
                                    {{-- <form action="{{ route('item.destroy', $stock->regist_number) }}" class="d-inline" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="return confirm('Are you sure to delete {{ $stock->regist_number ?? $stock->serial_number }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Restock Modal -->
        <div class="modal fade" id="restockModal" tabindex="-1" aria-labelledby="restockModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-gray-900">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restockModal">Restock Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stock.restock') }}" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                <div class="row m-3">
                                    <label for="stock_code" class="form-label">Stock Code</label>
                                    <input type="text" name="stock_code" id="stock_code" class="form-control @error('stock_code') is-invalid @enderror" 
                                        placeholder="" value="{{ $stockDetail->stock_code }}" disabled>
                                    @error('stock_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="stock_name" class="form-label">Stock Name</label>
                                    <input type="text" name="stock_name" id="stock_name" class="form-control @error('stock_name') is-invalid @enderror" 
                                        placeholder="" value="{{ $stockDetail->stock_name }}" disabled>
                                    @error('stock_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="amount" class="form-label">Amount ( {{ $stockDetail->stockUnit()->first()->unit }} )</label>
                                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                                        placeholder="0~999" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" 
                                        rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="stock_code" id="stock_code" value="{{ $stockDetail->stock_code }}">
                                @csrf
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stockout Modal -->
        <div class="modal fade" id="stockOutModal" tabindex="-1" aria-labelledby="stockOutModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-gray-900">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stockOutModal">Stock Out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('stock.out') }}" enctype="multipart/form-data" method="post">
                        <div class="modal-body">
                            <div class="justify-content-center">
                                <div class="row m-3">
                                    <label for="stock_code" class="form-label">Stock Code</label>
                                    <input type="text" name="stock_code" id="stock_code" class="form-control @error('stock_code') is-invalid @enderror" 
                                        placeholder="" value="{{ $stockDetail->stock_code }}" disabled>
                                    @error('stock_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="stock_name" class="form-label">Stock Name</label>
                                    <input type="text" name="stock_name" id="stock_name" class="form-control @error('stock_name') is-invalid @enderror" 
                                        placeholder="" value="{{ $stockDetail->stock_name }}" disabled>
                                    @error('stock_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="amount" class="form-label">Amount ( {{ $stockDetail->stockUnit()->first()->unit }} )</label>
                                    <input type="text" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                                        placeholder="0~999" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="receipent" class="form-label">Receipent/Requester</label>
                                    <input type="text" name="receipent" id="receipent" class="form-control @error('receipent') is-invalid @enderror" 
                                        placeholder="" value="{{ old('receipent') }}" required>
                                    @error('receipent')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" 
                                        rows="3" required>{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row m-3">
                                    <label for="files" class="form-label">Upload Receipt</label>
                                    <input type="file" name="files" id="files" accept="application/pdf" class="form-control @error('files') is-invalid @enderror" 
                                        placeholder="Upload File" value="{{ old('files') }}">
                                    @error('files')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="stock_code" id="stock_code" value="{{ $stockDetail->stock_code }}">
                                @csrf
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection