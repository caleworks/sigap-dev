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
            'company' => Company::all(),
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
}
