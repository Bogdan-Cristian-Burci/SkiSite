<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebcamRequest;
use App\Http\Resources\WebcamResource;
use App\Models\Webcam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WebcamController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Webcam::class);

        return WebcamResource::collection(Webcam::all());
    }

    public function store(WebcamRequest $request)
    {
        $this->authorize('create', Webcam::class);

        return new WebcamResource(Webcam::create($request->validated()));
    }

    public function show(Webcam $webcam)
    {
        $this->authorize('view', $webcam);

        return new WebcamResource($webcam);
    }

    public function update(WebcamRequest $request, Webcam $webcam)
    {
        $this->authorize('update', $webcam);

        $webcam->update($request->validated());

        return new WebcamResource($webcam);
    }

    public function destroy(Webcam $webcam)
    {
        $this->authorize('delete', $webcam);

        $webcam->delete();

        return response()->json(['message' => 'Webcam deleted successfully']);
    }

    public function webIndex()
    {
        $webcams = Webcam::all();
        return view('webcam', compact('webcams'));
    }
}
