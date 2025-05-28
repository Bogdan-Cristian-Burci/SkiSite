<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Http\Traits\HandlesImages;
use App\Models\Gallery;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GalleryController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index()
    {
        $this->authorize('viewAny', Gallery::class);

        return GalleryResource::collection(Gallery::all());
    }

    public function store(GalleryRequest $request)
    {
        $this->authorize('create', Gallery::class);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'gallery');
        }

        $gallery = Gallery::create($data);

        return new GalleryResource($gallery);
    }

    public function show(Gallery $gallery)
    {
        $this->authorize('view', $gallery);

        return new GalleryResource($gallery);
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $this->deleteImage($gallery->image_path);
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'gallery');
        }

        $gallery->update($data);

        return new GalleryResource($gallery);
    }

    public function destroy(Gallery $gallery)
    {
        $this->authorize('delete', $gallery);

        $this->deleteImage($gallery->image_path);
        $gallery->delete();

        return response()->json(['message' => 'Gallery item deleted successfully']);
    }

    public function webIndex()
    {
        $galleries = Gallery::all();
        return view('gallery', compact('galleries'));
    }
}
