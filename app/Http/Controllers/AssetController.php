<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.asset.index', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'active',
            'assets' => Asset::with(['assetCategory'])->with(['assetUnit'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.asset.create', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'active',
            'categories' => Category::all(),
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
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.asset.show', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'inactive',
            'assetDetail' => Asset::with(['assetCategory'])
                ->with(['assetCategory'])
                ->where('asset_code', $id)
                ->firstOrFail(),
            //'assets' => Asset::where('product_code', $id)->latest()->limit(10)->get(),
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
        return view('pages.asset.edit', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'inactive',
            'assetDetail' => Asset::where('asset_code', $id)->firstOrFail(),
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
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset::destroy($id);
        return redirect('asset.index');
    }
}
