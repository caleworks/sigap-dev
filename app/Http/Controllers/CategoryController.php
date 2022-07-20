<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category', [
            'title' => 'Category',
            'active' => 'category',
            'table' => 'active',
            'categories' => Category::all(),
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
        $validatedData = $request->validate([
            'category' => ['required', 'unique:categories','max:255'],
            'slug' => ['required', 'unique:categories', 'max:255'],
        ]);

        Category::create($validatedData);
        return redirect('category');
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
        return view('admin.category', [
            'title' => 'Category',
            'active' => 'category',
            'table' => 'active',
            'category' => Category::findOrFail($id),
            'categories' => Category::all(),
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
    public function update(Request $request, Category $category)
    {
        if ($request->slug != $category->slug) {
            $rules = [
                'slug' => ['required', 'unique:categories', 'max:255'],
                'category' => ['required', 'max:255'],
            ];
        } else {
            $rules = [
                'slug' => ['required', 'max:255'],
                'category' => ['required', 'max:255'],
            ];
        }

        $validatedData = $request->validate($rules);

        //return $validatedData;
        Category::whereId($category->id)->update($validatedData);
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('category');
    }
}
