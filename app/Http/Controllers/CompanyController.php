<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Company/Company', ['companies' => Company::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Company/CreateCompany');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
            'logo' => ['required','file','max:3000','mimes:png,jpg,jpeg'],
            'status' => ['required'],
        ]);

        $path = "";
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = $file->hashName();
            $path = Storage::disk('public')->putFileAs(
                'logos', $request->file('logo'), $filename
            );
        }

        $fields['logo'] = $path;

        $company = Company::create($fields);
        return redirect()->intended('company');

    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return inertia('Company/EditCompany', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $fields = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $path = $company->logo;
        if($request->hasFile('logo')){
            $fields['logo'] = $request->validate([
                'logo' => ['required','file','max:3000','mimes:png,jpg,jpeg'],
            ]);

            $file = $request->file('logo');
            $filename = $file->hashName();
            $path = Storage::disk('public')->putFileAs(
                'logos', $request->file('logo'), $filename
            );

            $fields['logo'] = $path;
        }

        $company->update($fields);
        return redirect()->intended('company');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->intended('company');
    }
}
