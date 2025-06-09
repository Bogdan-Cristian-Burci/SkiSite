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
        
        // Check if user is already registered for this camp
        $userRegistration = null;
        if (auth()->check()) {
            $userRegistration = auth()->user()->camps()
                ->where('camp_id', $camp->id)
                ->first();
        }
        
        // Calculate taken spots (sum of adults + children for all registrations)
        $takenSpots = $camp->users()
            ->selectRaw('SUM(number_of_adults + number_of_children) as total_spots')
            ->value('total_spots') ?? 0;
        
        // Calculate available spots
        $availableSpots = max(0, $camp->capacity - $takenSpots);
        
        return view('camp-details', compact('camp', 'userRegistration', 'takenSpots', 'availableSpots'));
    }

    public function book(Request $request, Camp $camp)
    {
        $user = auth()->user();
        
        // Validate the request
        $request->validate([
            'number_of_adults' => 'required|integer|min:0|max:10',
            'number_of_children' => 'required|integer|min:0|max:10',
        ]);
        
        // Check if at least one person is specified
        if ($request->number_of_adults == 0 && $request->number_of_children == 0) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('Please specify at least one adult or child.')
                ], 422);
            }
            return redirect()->back()->with('error', __('Please specify at least one adult or child.'));
        }
        
        // Check if user is already booked for this camp
        if ($user->camps()->where('camp_id', $camp->id)->exists()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('You are already registered for this camp.')
                ], 422);
            }
            return redirect()->back()->with('error', __('You are already registered for this camp.'));
        }
        
        // Book the user to the camp
        $user->camps()->attach($camp->id, [
            'number_of_adults' => $request->number_of_adults,
            'number_of_children' => $request->number_of_children,
        ]);
        
        // Return appropriate response based on request type
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Successfully registered for the camp!')
            ]);
        }
        
        return redirect()->back()->with('success', __('Successfully registered for the camp!'));
    }

    public function updateRegistration(Request $request, Camp $camp)
    {
        $user = auth()->user();
        
        // Validate the request
        $request->validate([
            'number_of_adults' => 'required|integer|min:0|max:10',
            'number_of_children' => 'required|integer|min:0|max:10',
        ]);
        
        // Check if at least one person is specified
        if ($request->number_of_adults == 0 && $request->number_of_children == 0) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('Please specify at least one adult or child.')
                ], 422);
            }
            return redirect()->back()->with('error', __('Please specify at least one adult or child.'));
        }
        
        // Check if user is registered for this camp
        if (!$user->camps()->where('camp_id', $camp->id)->exists()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('You are not registered for this camp.')
                ], 422);
            }
            return redirect()->back()->with('error', __('You are not registered for this camp.'));
        }
        
        // Update the registration
        $user->camps()->updateExistingPivot($camp->id, [
            'number_of_adults' => $request->number_of_adults,
            'number_of_children' => $request->number_of_children,
        ]);
        
        // Return appropriate response based on request type
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Registration updated successfully!')
            ]);
        }
        
        return redirect()->back()->with('success', __('Registration updated successfully!'));
    }

    public function cancelRegistration(Request $request, Camp $camp)
    {
        $user = auth()->user();
        
        // Check if user is registered for this camp
        if (!$user->camps()->where('camp_id', $camp->id)->exists()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('You are not registered for this camp.')
                ], 422);
            }
            return redirect()->back()->with('error', __('You are not registered for this camp.'));
        }
        
        // Cancel the registration
        $user->camps()->detach($camp->id);
        
        // Return appropriate response based on request type
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Registration cancelled successfully!')
            ]);
        }
        
        return redirect()->back()->with('success', __('Registration cancelled successfully!'));
    }
}
