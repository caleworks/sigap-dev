<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Stock;
use App\Models\Category;
use Illuminate\Http\Request;

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
        //
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

        return redirect()->route('stock.index');
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
}