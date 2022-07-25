<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyAccess;
use App\Models\User;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.company', [
            'title' => 'Company',
            'active' => 'company',
            'table' => 'active',
            'companies' => Company::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('company');
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
            'company_name' => ['required', 'unique:companies','max:255'],
            'alias' => ['required', 'unique:companies', 'max:255'],
        ]);

        Company::create($validatedData);
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
        return redirect('company');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.company', [
            'title' => 'Company',
            'active' => 'company',
            'table' => 'active',
            'company' => Company::findOrFail($id),
            'companies' => Company::all(),
            'edit' => true,
        ]);

        //return Company::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        if ($request->alias != $company->alias && $request->company_name != $company->company_name) {
            $rules = [
                'alias' => ['required', 'unique:companies', 'max:255'],
                'company_name' => ['required', 'unique:companies', 'max:255'],
            ];
        } else if ($request->alias == $company->alias && $request->company_name != $company->company_name) {
            $rules = [
                'alias' => ['required', 'max:255'],
                'company_name' => ['required', 'unique:companies', 'max:255'],
            ];
        } else if ($request->alias != $company->alias && $request->company_name == $company->company_name) {
            $rules = [
                'alias' => ['required', 'unique:companies', 'max:255'],
                'company_name' => ['required', 'max:255'],
            ];
        } else {
            $rules = [
                'alias' => ['required', 'max:255'],
                'company_name' => ['required', 'max:255'],
            ];
        }

        $validatedData = $request->validate($rules);

        //return $validatedData;
        Company::whereId($company->id)->update($validatedData);
        return redirect('company');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::destroy($id);
        return back();
    }

    public function userAccess($id)
    {
        return view('admin.companyAccess', [
            'title' => 'Company',
            'active' => 'company',
            'table' => 'active',
            'withAccess' => CompanyAccess::grantedUsers($id)->get(),
            'company' => Company::findOrFail($id),
        ]);

        //return CompanyAccess::grantedUsers($id);
    }

    public function grantAccess(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email:dns', 'max:255', 'exists:users'],
        ]);

        $getIdUser = User::whereEmail($validatedData['email'])->get();

        $store = [
            'user_id' => $getIdUser[0]['id'],
            'company_id' => $id,
        ];

        CompanyAccess::create($store);
        return back();

    }

    public function destroyAccess($id)
    {
        CompanyAccess::destroy($id);
        return back();
    }

}
