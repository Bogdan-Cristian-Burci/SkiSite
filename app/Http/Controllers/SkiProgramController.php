<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkiProgramRequest;
use App\Http\Resources\SkiProgramResource;
use App\Http\Traits\HandlesImages;
use App\Models\SkiProgram;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkiProgramController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index(Request $request)
    {
        $this->authorize('viewAny', SkiProgram::class);

        $programs = SkiProgram::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $programs->where(function($query) use ($search) {
                $query->whereJsonContains('title->en', $search)
                      ->orWhereJsonContains('title->ro', $search)
                      ->orWhereJsonContains('description->en', $search)
                      ->orWhereJsonContains('description->ro', $search);
            });
        }

        return SkiProgramResource::collection($programs->get());
    }

    public function store(SkiProgramRequest $request)
    {
        $this->authorize('create', SkiProgram::class);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'ski-programs');
        }

        if ($request->hasFile('gallery')) {
            $data['gallery'] = $this->handleMultipleImageUploads($request->file('gallery'), 'ski-programs/gallery');
        }

        // Generate slugs if not provided
        if (!isset($data['slug']['en']) && isset($data['title']['en'])) {
            $data['slug']['en'] = Str::slug($data['title']['en']);
        }
        if (!isset($data['slug']['ro']) && isset($data['title']['ro'])) {
            $data['slug']['ro'] = Str::slug($data['title']['ro']);
        }

        $skiProgram = SkiProgram::create($data);

        return new SkiProgramResource($skiProgram);
    }

    public function show(SkiProgram $skiProgram)
    {
        $this->authorize('view', $skiProgram);

        return new SkiProgramResource($skiProgram);
    }

    public function update(SkiProgramRequest $request, SkiProgram $skiProgram)
    {
        $this->authorize('update', $skiProgram);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $this->deleteImage($skiProgram->image_path);
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'ski-programs');
        }

        if ($request->hasFile('gallery')) {
            $this->deleteMultipleImages($skiProgram->gallery);
            $data['gallery'] = $this->handleMultipleImageUploads($request->file('gallery'), 'ski-programs/gallery');
        }

        $skiProgram->update($data);

        return new SkiProgramResource($skiProgram);
    }

    public function destroy(SkiProgram $skiProgram)
    {
        $this->authorize('delete', $skiProgram);

        $this->deleteImage($skiProgram->image_path);
        $this->deleteMultipleImages($skiProgram->gallery);

        $skiProgram->delete();

        return response()->json(['message' => 'Ski program deleted successfully']);
    }

    public function webIndex()
    {
        $programs = SkiProgram::all();
        return view('programs', compact('programs'));
    }

    public function webShow($slug)
    {
        $locale = app()->getLocale();
        $skiProgram = SkiProgram::whereJsonContains("slug->{$locale}", $slug)->firstOrFail();
        
        return view('program-page', compact('skiProgram'));
    }
}
