<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.unit.index', [
            'title' => 'Unit',
            'active' => 'unit',
            'table' => 'active',
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
        return redirect('unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit' => ['required', 'unique:units','max:255'],
        ]);

        Unit::create($validatedData);
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
        return redirect('unit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.unit.index', [
            'title' => 'Unit',
            'active' => 'unit',
            'table' => 'active',
            'unit' => Unit::findOrFail($id),
            'units' => Unit::all(),
            'edit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        if ($request->unit != $unit->unit) {
            $rules = [
                'unit' => ['required', 'unique:units', 'max:255'],
            ];
        } else {
            $rules = [
                'unit' => ['required', 'max:255'],
            ];
        }

        $validatedData = $request->validate($rules);

        Unit::whereId($unit->id)->update($validatedData);
        return redirect('unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::destroy($id);
        return back();
    }
}
