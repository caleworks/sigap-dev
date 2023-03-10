<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'table' => 'non-active',
        ]);
    }
}
