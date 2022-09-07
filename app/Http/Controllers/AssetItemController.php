<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Asset;
use App\Models\Category;
use App\Models\AssetItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'table' => 'inactive',
            'assetDetail' => Asset::where('asset_code', $asset_code)->firstOrFail(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Asset $asset)
    {
        $rules['serial_number'] = 'required|unique:asset_items|max:255';
        $rules['regist_number'] = 'required|unique:asset_items|max:255';
        $rules['status'] = 'required|in:ready,delivered,maintenance,broken,other';
        $rules['deliver_to'] = 'max:255|required_if:status,delivered';
        $rules['location'] = 'max:255';
        $rules['date_purchase'] = 'required|date_format:Y-m-d';
        $rules['date_deliver'] = 'nullable|date_format:Y-m-d|required_if:status,delivered';
        $rules['files'] = 'nullable|file|mimes:pdf';
        $rules['notes'] = 'max:255';
        
        $validatedData = $request->validate($rules);
        $validatedData['asset_id'] = $asset->id;
        $validatedData['asset_code'] = $asset->asset_code;

        if($request->hasFile('files'))
        {
            $path = $request->file('files')->storeAs('public/bast', $item->regist_number.'_'.Str::random(8).'.pdf');
            $validatedData['scan_bast'] = $path;
        }

        AssetItem::create($validatedData);

        return redirect()->route('asset.show', $asset->asset_code);
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
            'table' => 'inative',
            'assetItem' => $assetItem,
            'assetDetail' => Asset::where('asset_code', $assetItem->asset_code)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetItem $item)
    {

        if ($request->serial_number != $item->serial_number) {
            $rules['serial_number'] = 'required|unique:asset_items|max:255';
        } else {
            $rules['serial_number'] = 'required|max:255';
        }
        
        $rules['status'] = 'required|in:ready,delivered,maintenance,broken,other';
        $rules['deliver_to'] = 'max:255|required_if:status,delivered';
        $rules['location'] = 'max:255';
        $rules['date_purchase'] = 'required|date_format:Y-m-d';
        $rules['date_deliver'] = 'nullable|date_format:Y-m-d|required_if:status,delivered';
        $rules['files'] = 'nullable|file|mimes:pdf';
        $rules['notes'] = 'max:255';
        
        $validatedData = $request->validate($rules);

        if($request->hasFile('files'))
        {
            Storage::delete($item->scan_bast);
            $path = $request->file('files')->storeAs('public/bast', $item->regist_number.'_'.Str::random(8).'.pdf');
            $validatedData['scan_bast'] = $path;
        }

        $item->update($validatedData);

        return redirect()->route('asset.show', $item->asset_code);

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

    public function delete_pdf(AssetItem $item)
    {
        Storage::delete($item->scan_bast);

        $data['scan_bast'] = NULL;
        $item->update($data);

        return back();
    }
}
