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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user', [
            'title' => 'User',
            'active' => 'user',
            'table' => 'active',
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('user');
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //return $request->all();

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
        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.user', [
            'title' => 'User',
            'active' => 'user',
            'table' => 'active',
            'users' => User::all(),
            'user' => User::findOrFail($id),
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
    public function update(Request $request, User $user)
    {
        if($request->password != NULL) {
            $validatedData = $request->validate([
                'password' => ['required', 'confirmed', Password::min(8)],
                'role' => ['required']
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            $validatedData = $request->validate([
                'role' => ['required']
            ]);
        }

        User::whereId($user->id)->update($validatedData);
        return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function disableUser($id)
    {
        $validatedData = [
            'is_active' => 0,
        ];

        User::whereId($id)->update($validatedData);
        return back();
    }

    public function enableUser($id)
    {
        $validatedData = [
            'is_active' => 1,
        ];
        
        User::whereId($id)->update($validatedData);
        return back();
    }
}
