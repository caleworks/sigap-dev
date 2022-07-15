<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

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
            'users' => User::all(),
        ]);
    }

    public function store_user(Request $request) 
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)]
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //return $request->all();

        return redirect('user');
    }
}
