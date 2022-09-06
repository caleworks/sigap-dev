<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Asset;
use App\Models\Category;
use App\Models\AssetItem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

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
            'assets' => Asset::withCount('assetItems')->withCount([
                'assetItems',
                'assetItems as readyItems' => function (Builder $query) {
                    $query->where('status', 'ready');
                },
            ])->withCount([
                'assetItems',
                'assetItems as deliveredItems' => function (Builder $query) {
                    $query->where('status', 'delivered');
                },
            ])->get(),
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
            'table' => 'inactive',
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
        $rules['asset_code'] = 'required|unique:assets|max:255';
        $rules['asset_name'] = 'required|unique:assets|max:255';
        $rules['category_id'] = 'required|numeric';
        $rules['unit_id'] = 'required|numeric';
        $rules['description'] = 'string|nullable';
        $rules['notes'] = 'string|nullable|max:255';
        
        $validatedData = $request->validate($rules);

        Asset::create($validatedData);

        return redirect()->route('asset.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $assetDetail = Asset::where('asset_code', $id)->firstOrFail();
        $assets = AssetItem::where('asset_id', $assetDetail->id)->get();

        return view('pages.asset.show', [
            'title' => 'Assets',
            'active' => 'asset',
            'table' => 'active',
            'assetDetail' => $assetDetail,
            'assets' => $assets,
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
        $asset = Asset::whereId($id)->first();

        if($request->asset_code != $asset->asset_code) {
            $rules['asset_code'] = 'required|unique:assets|max:255';
        } else {
            $rules['asset_code'] = 'required|max:255';
        }

        if($request->asset_name != $asset->asset_name) {
            $rules['asset_name'] = 'required|unique:assets|max:255';
        } else {
            $rules['asset_name'] = 'required|max:255';
        }

        $rules['category_id'] = 'required|numeric';
        $rules['unit_id'] = 'required|numeric';
        $rules['description'] = 'string|nullable';
        $rules['notes'] = 'string|nullable|max:255';
        
        $validatedData = $request->validate($rules);

        $asset->update($validatedData);

        return redirect()->route('asset.show', $asset->asset_code);
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
        return redirect()->route('asset.index');
    }
}
