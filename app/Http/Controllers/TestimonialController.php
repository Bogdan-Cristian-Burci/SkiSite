<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Http\Resources\TestimonialResource;
use App\Http\Traits\HandlesImages;
use App\Models\Testimonial;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TestimonialController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index()
    {
        $this->authorize('viewAny', Testimonial::class);

        $testimonials = Testimonial::where('approved_status', true)->get();
        return TestimonialResource::collection($testimonials);
    }

    public function store(TestimonialRequest $request)
    {
        $this->authorize('create', Testimonial::class);

        $data = $request->validated();

        $testimonial = Testimonial::create($data);

        return new TestimonialResource($testimonial);
    }

    public function show(Testimonial $testimonial)
    {
        $this->authorize('view', $testimonial);

        return new TestimonialResource($testimonial);
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);

        $data = $request->validated();

        $testimonial->update($data);

        return new TestimonialResource($testimonial);
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->authorize('delete', $testimonial);

        $testimonial->delete();

        return response()->json(['message' => 'Testimonial deleted successfully']);
    }

    public function webIndex()
    {
        $testimonials = Testimonial::where('approved_status', true)->get();
        return view('testimonials', compact('testimonials'));
    }
}
