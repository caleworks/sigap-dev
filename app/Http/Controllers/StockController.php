<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Stock;
use App\Models\StockIn;
use App\Models\Category;
use App\Models\StockOut;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stock.index', [
            'title' => 'MRO Stock',
            'active' => 'stock',
            'table' => 'active',
            'stocks' => Stock::get(),
            'countAllStock' => Stock::count(),
            'countOnStock' => Stock::whereBetweenColumns('stock', ['fix_stock', 'max_stock'])->count(),
            'countOverStock' => Stock::whereColumn('stock', '>', 'max_stock')->count(),
            'countMinusStock' => Stock::whereColumn('stock', '<', 'fix_stock')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.stock.create', [
            'title' => 'MRO Stock',
            'active' => 'stock',
            'table' => 'inactive',
            'categories' => Category::where('type', 0)->get(),
            'units' => Unit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['stock_code'] = 'required|unique:stocks|max:25';
        $rules['stock_name'] = 'required|unique:stocks|max:255';
        $rules['fix_stock'] = 'required|integer';
        $rules['max_stock'] = 'required|integer';
        $rules['stock'] = 'required|integer';
        $rules['category_id'] = 'required|exists:categories,id|numeric';
        $rules['unit_id'] = 'required|exists:units,id|numeric';
        $rules['stored_at'] = 'string|nullable|max:50';
        $rules['notes'] = 'string|nullable|max:255';
        
        $validatedData = $request->validate($rules);

        Stock::create($validatedData);

        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stockDetail = Stock::where('stock_code', $id)->firstOrFail();

        $stockin = StockIn::where('stock_id', $stockDetail->id)->get();
        $stockout = StockOut::where('stock_id', $stockDetail->id)->get();

        return view('pages.stock.show', [
            'title' => 'MRO Stock',
            'active' => 'stock',
            'table' => 'active',
            'stockDetail' => $stockDetail,
            'transactions' => Arr::collapse([$stockin, $stockout]),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.stock.edit', [
            'title' => 'MRO Stock',
            'active' => 'stock',
            'table' => 'inactive',
            'stockDetail' => Stock::where('stock_code', $id)->firstOrFail(),
            'categories' => Category::where('type', 0)->get(),
            'units' => Unit::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        if($request->stock_code != $stock->stock_code) {
            $rules['stock_code'] = 'required|unique:stocks|max:25';
        } else {
            $rules['stock_code'] = 'required|max:25';
        }

        if($request->stock_name != $stock->stock_name) {
            $rules['stock_name'] = 'required|unique:stocks|max:255';
        } else {
            $rules['stock_name'] = 'required|max:255';
        }

        $rules['fix_stock'] = 'required|integer';
        $rules['max_stock'] = 'required|integer';
        $rules['category_id'] = 'required|exists:categories,id|numeric';
        $rules['unit_id'] = 'required|exists:units,id|numeric';
        $rules['stored_at'] = 'string|nullable|max:50';
        $rules['notes'] = 'string|nullable|max:255';
        
        $validatedData = $request->validate($rules);

        $stock->update($validatedData);

        return redirect()->route('stock.show', $stock->stock_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::destroy($id);
        return redirect()->route('stock.index');
    }

    public function restock(Request $request)
    {
        $rules['stock_code'] = 'required|exists:stocks,stock_code|max:25';
        $rules['amount'] = 'required|integer';
        $rules['notes'] = 'string|nullable|max:255';
        
        $validatedData = $request->validate($rules);
        
        $stock = Stock::where('stock_code', $request->stock_code)->firstOrFail();
        $validatedData['stock_id'] = $stock->id;
        $validatedData['user_id'] = Auth::user()->id;

        //generate transaction_code PPD-G-IN-1022-003
        $validatedData['transaction_code'] = "PPD-G-IN-" . date('ny') . sprintf("-%03s", abs(StockIn::max('id') + 1));

        //update stock
        $new_stock = $stock->stock + $request->amount;
        $stock->update(['stock' => $new_stock]);
        
        StockIn::create($validatedData);

        return redirect()->route('stock.show', $request->stock_code);
    }

    public function stockout(Request $request)
    {
        // user_id, stock_id, transaction_code, amount, receipent, notes, receipt
        $stock = Stock::where('stock_code', $request->stock_code)->firstOrFail();

        $rules['stock_code'] = 'required|exists:stocks,stock_code|max:25';
        $rules['amount'] = 'required|max:'.$stock->stock.'|integer';
        $rules['receipent'] = 'required|max:255';
        $rules['notes'] = 'string|nullable|max:255';
        $rules['files'] = 'nullable|file|mimes:pdf';
        
        $validatedData = $request->validate($rules);
        $validatedData['stock_id'] = $stock->id;
        $validatedData['user_id'] = Auth::user()->id;

        //generate transaction_code PPD-G-IN-1022-003
        $validatedData['transaction_code'] = "PPD-G-OUT-" . date('ny') . sprintf("-%03s", abs(StockOut::max('id') + 1));

        //Upload File Receipt
        if($request->hasFile('files'))
        {
            $path = $request->file('files')->storeAs('public/receipt', $validatedData['transaction_code'].'_'.Str::random(8).'.pdf');
            $validatedData['receipt'] = $path;
        }

        //update stock
        $new_stock = $stock->stock - $request->amount;
        $stock->update(['stock' => $new_stock]);
        
        StockOut::create($validatedData);

        return redirect()->route('stock.show', $request->stock_code);
    }
}
