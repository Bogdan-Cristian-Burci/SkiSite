<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampRequest;
use App\Http\Resources\CampResource;
use App\Http\Traits\HandlesImages;
use App\Models\Camp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Camp::class);

        $camps = Camp::query();
        
        if ($request->has('upcoming')) {
            $camps->where('start_date', '>=', now());
        }
        
        if ($request->has('location')) {
            $camps->whereJsonContains('location->en', $request->location)
                  ->orWhereJsonContains('location->ro', $request->location);
        }

        return CampResource::collection($camps->orderBy('start_date')->get());
    }

    public function store(CampRequest $request)
    {
        $this->authorize('create', Camp::class);

        $data = $request->validated();
        
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $this->handleImageUpload($request->file('image_path'), 'camps');
        }

        // Generate slugs if not provided
        if (!isset($data['slug']['en']) && isset($data['title']['en'])) {
            $data['slug']['en'] = Str::slug($data['title']['en']);
        }
        if (!isset($data['slug']['ro']) && isset($data['title']['ro'])) {
            $data['slug']['ro'] = Str::slug($data['title']['ro']);
        }

        $camp = Camp::create($data);

        return new CampResource($camp);
    }

    public function show(Camp $camp)
    {
        $this->authorize('view', $camp);

        return new CampResource($camp);
    }

    public function update(CampRequest $request, Camp $camp)
    {
        $this->authorize('update', $camp);

        $data = $request->validated();
        
        if ($request->hasFile('image_path')) {
            $this->deleteImage($camp->image_path);
            $data['image_path'] = $this->handleImageUpload($request->file('image_path'), 'camps');
        }

        $camp->update($data);

        return new CampResource($camp);
    }

    public function destroy(Camp $camp)
    {
        $this->authorize('delete', $camp);

        $this->deleteImage($camp->image_path);
        $camp->delete();

        return response()->json(['message' => 'Camp deleted successfully']);
    }

    public function webIndex()
    {
        $camps = Camp::orderBy('start_date')->get();
        return view('camps', compact('camps'));
    }

    public function webShow($slug)
    {
        $locale = app()->getLocale();
        $camp = Camp::whereJsonContains("slug->{$locale}", $slug)->firstOrFail();
        
        return view('camp-details', compact('camp'));
    }
}
