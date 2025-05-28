<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Traits\HandlesImages;
use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index()
    {
        $this->authorize('viewAny', Company::class);

        return CompanyResource::collection(Company::all());
    }

    public function store(CompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $data = $request->validated();
        
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->handleImageUpload($request->file('logo'), 'company/logos');
        }

        $company = Company::create($data);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);

        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $data = $request->validated();
        
        if ($request->hasFile('logo')) {
            $this->deleteImage($company->logo_path);
            $data['logo_path'] = $this->handleImageUpload($request->file('logo'), 'company/logos');
        }

        $company->update($data);

        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $this->deleteImage($company->logo_path);
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully']);
    }

    public function webIndex()
    {
        $company = Company::first();
        return view('about', compact('company'));
    }
}
