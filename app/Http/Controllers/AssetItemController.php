<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Asset;
use App\Models\Category;
use App\Models\AssetItem;
use Illuminate\Http\Request;

class AssetItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($asset_code)
    {
        return view('pages.asset.itemCreate', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'active',
            'assetDetail' => Asset::where('asset_code', $asset_code)->first(),
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($regist_number)
    {
        $assetItem = AssetItem::where('regist_number', $regist_number)->first();

        return view('pages.asset.itemEdit', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'active',
            'assetItem' => $assetItem,
            'assetDetail' => Asset::where('asset_code', $assetItem->asset_code)->first(),
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
        $asset = AssetItem::where('regist_number', $id)->first();

        AssetItem::destroy($asset->id);

        return back();
    }
}
