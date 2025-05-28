<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegulationRequest;
use App\Http\Resources\RegulationResource;
use App\Models\Regulation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class RegulationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Regulation::class);

        return RegulationResource::collection(Regulation::all());
    }

    public function webIndex()
    {
        $regulations = Regulation::all();
        return view('regulation', compact('regulations'));
    }

    public function store(RegulationRequest $request)
    {
        $this->authorize('create', Regulation::class);

        $data = $request->validated();
        
        // Generate slugs if not provided
        if (!isset($data['slug']['en']) && isset($data['title']['en'])) {
            $data['slug']['en'] = Str::slug($data['title']['en']);
        }
        if (!isset($data['slug']['ro']) && isset($data['title']['ro'])) {
            $data['slug']['ro'] = Str::slug($data['title']['ro']);
        }

        return new RegulationResource(Regulation::create($data));
    }

    public function show(Regulation $regulation)
    {
        $this->authorize('view', $regulation);

        return new RegulationResource($regulation);
    }

    public function update(RegulationRequest $request, Regulation $regulation)
    {
        $this->authorize('update', $regulation);

        $regulation->update($request->validated());

        return new RegulationResource($regulation);
    }

    public function destroy(Regulation $regulation)
    {
        $this->authorize('delete', $regulation);

        $regulation->delete();

        return response()->json();
    }

    public function webShow($slug)
    {
        $locale = app()->getLocale();
        $regulation = Regulation::whereJsonContains("slug->{$locale}", $slug)->firstOrFail();
        
        return view('regulation-details', compact('regulation'));
    }
}
