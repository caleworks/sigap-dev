@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            <a href="{{ route('stock.create') }}" class="d-none d-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Restock
            </a>
        </div>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Restock History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Code</th>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Amount</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Code</th>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Amount</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($stock_ins as $stock_in)
                            <tr>
                                <td>{{ optional($stock_in->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $stock_in->transaction_code }}</td>
                                <td>{{ $stock_in->stock()->first()->stock_code }}</td>
                                <td>{{ $stock_in->stock()->first()->stock_name }}</td>
                                <td>{{ $stock_in->amount }} {{ $stock_in->stock()->first()->unit }}</td>
                                <td>{{ $stock_in->notes }}</td>
                                <td>
                                    <form action="" class="d-inline" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle btn-sm" title="Delete" onclick="return confirm('Are you sure to delete this restock transaction? \n{{ $stock_in->transaction_code }}')">
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