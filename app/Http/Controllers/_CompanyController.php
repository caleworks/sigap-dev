<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company', [
            'title' => 'Company',
            'active' => 'company',
            'table' => 'active',
            'companies' => Company::all(),
        ]);
    }

    public function store_company(Request $request) 
    {
        $validatedData = $request->validate([
            'company_name' => ['required', 'unique:companies','max:255'],
            'alias' => ['required', 'unique:companies', 'max:255'],
        ]);

        Company::create($validatedData);
        return redirect('company');
    }

    public function destroy(Company $company)
    {
        Company::destroy($company->id);
        return redirect('company');
    }

    public function edit(Company $company)
    {
        return view('admin.company', [
            'title' => 'Company',
            'active' => 'company',
            'table' => 'active',
            'company' => $company,
            'companies' => Company::all(),
            'edit' => true,
        ]);
    }

    public function update(company $company, Request $request)
    {
        
        $rules['company_name'] = ['required', 'max:255'];
        $rules['alias'] = ['required', 'max:255'];


        if ($request->company_name != $company->company_name) 
        {
            $rules['company_name'] = ['required', 'unique:companies','max:255'];
        }

        if ($request->alias != $company->alias) 
        {
            $rules['alias'] = ['required', 'unique:companies','max:255'];
        }

        $validatedData = $request->validate($rules);

        Company::where('id', $company->id)->update($validatedData);

        return redirect('company');
    }
}
