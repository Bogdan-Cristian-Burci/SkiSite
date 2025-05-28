<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Categories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoriesController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Categories::class);

        return CategoriesResource::collection(Categories::all());
    }

    public function store(CategoriesRequest $request)
    {
        $this->authorize('create', Categories::class);

        return new CategoriesResource(Categories::create($request->validated()));
    }

    public function show(Categories $categories)
    {
        $this->authorize('view', $categories);

        return new CategoriesResource($categories);
    }

    public function update(CategoriesRequest $request, Categories $categories)
    {
        $this->authorize('update', $categories);

        $categories->update($request->validated());

        return new CategoriesResource($categories);
    }

    public function destroy(Categories $categories)
    {
        $this->authorize('delete', $categories);

        $categories->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
