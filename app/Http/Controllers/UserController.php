<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        return view('admin.user', [
            'title' => 'User',
            'active' => 'user',
        ]);
    }

    public function add()
    {
        return view('admin.useradd', [
            'title' => 'User',
            'active' => 'user',
        ]);
    }
}
