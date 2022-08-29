<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Asset;
use App\Models\Category;
use App\Models\ProductSpec;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.productSpecs', [
            'title' => 'Product Specs',
            'active' => 'asset',
            'table' => 'active',
            'productSpec' => ProductSpec::with(['productCategories'])->get(),
            'categories' => Category::all(),
            'units' => Unit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['product_code'] = 'required|unique:product_specs|max:255';
        $rules['name'] = 'required|unique:product_specs|max:255';
        $rules['category_id'] = 'required|numeric';
        $rules['unit_id'] = 'required|numeric';
        $rules['specification'] = 'string';
        $rules['notes'] = 'max:255';
        
        $validatedData = $request->validate($rules);

        ProductSpec::create($validatedData);

        return back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.productSpecsShow', [
            'title' => 'Product Specs',
            'active' => 'asset',
            'table' => 'inactive',
            'productDetail' => ProductSpec::with(['productCategories'])
                ->with(['productUnits'])
                ->where('product_code', $id)
                ->firstOrFail(),
            'assets' => Asset::where('product_code', $id)->latest()->limit(10)->get(),
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
        return view('admin.productSpecsShow', [
            'title' => 'Product Specs',
            'active' => 'asset',
            'table' => 'inactive',
            'edit' => true,
            'productDetail' => ProductSpec::where('product_code', $id)->firstOrFail(),
            'categories' => Category::all(),
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
    public function update(Request $request, $id)
    {   
        $ProductSpec = ProductSpec::whereId($id)->first();

        if($request->product_code != $ProductSpec->product_code) {
            $rules['product_code'] = 'required|unique:product_specs|max:255';
        } else {
            $rules['product_code'] = 'required|max:255';
        }

        if($request->name != $ProductSpec->name) {
            $rules['name'] = 'required|unique:product_specs|max:255';
        } else {
            $rules['name'] = 'required|max:255';
        }

        $rules['category_id'] = 'required|numeric';
        $rules['unit_id'] = 'required|numeric';
        $rules['specification'] = '';
        $rules['notes'] = 'max:255';
        
        $validatedData = $request->validate($rules);

        $ProductSpec->update($validatedData);

        return redirect()->route('asset.product.show', $ProductSpec->product_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductSpec::destroy($id);
        return redirect('asset.product.index');
    }
}
