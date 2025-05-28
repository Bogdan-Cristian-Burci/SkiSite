<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkiInstructorRequest;
use App\Http\Resources\SkiInstructorResource;
use App\Http\Traits\HandlesImages;
use App\Models\SkiInstructor;
use App\Models\User;
use App\Notifications\InstructorInvitation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SkiInstructorController extends Controller
{
    use AuthorizesRequests, HandlesImages;

    public function index()
    {
        $this->authorize('viewAny', SkiInstructor::class);

        $instructors = SkiInstructor::with('user')->get();
        return SkiInstructorResource::collection($instructors);
    }

    public function store(SkiInstructorRequest $request)
    {
        $this->authorize('create', SkiInstructor::class);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'instructors');
        }

        // Handle user creation or selection
        if (!empty($data['instructor_name']) && !empty($data['instructor_email'])) {
            // Create new user for instructor
            $user = $this->createInstructorUser($data['instructor_name'], $data['instructor_email'], $data['instructor_phone'] ?? null);
            $data['user_id'] = $user->id;
            $data['slug'] = $data['slug'] ?? Str::slug($data['instructor_name']);
        } elseif (!empty($data['user_id'])) {
            // Use existing user
            $user = User::findOrFail($data['user_id']);
            $data['slug'] = $data['slug'] ?? Str::slug($user->name);
        } else {
            // Neither new user data nor existing user selected
            throw new \InvalidArgumentException('Either instructor_name and instructor_email must be provided, or an existing user_id must be selected.');
        }

        // Remove instructor fields from data as they don't belong in ski_instructors table
        unset($data['instructor_name'], $data['instructor_email'], $data['instructor_phone']);

        $instructor = SkiInstructor::create($data);

        return new SkiInstructorResource($instructor->load('user'));
    }

    public function show(SkiInstructor $skiInstructor)
    {
        $this->authorize('view', $skiInstructor);

        return new SkiInstructorResource($skiInstructor->load('user'));
    }

    public function update(SkiInstructorRequest $request, SkiInstructor $skiInstructor)
    {
        $this->authorize('update', $skiInstructor);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($skiInstructor->image_path);
            $data['image_path'] = $this->handleImageUpload($request->file('image'), 'instructors');
        }


        $skiInstructor->update($data);

        return new SkiInstructorResource($skiInstructor->load('user'));
    }

    public function destroy(SkiInstructor $skiInstructor)
    {
        $this->authorize('delete', $skiInstructor);

        $this->deleteImage($skiInstructor->image_path);
        $skiInstructor->delete();

        return response()->json(['message' => 'Ski instructor deleted successfully']);
    }

    public function webIndex()
    {
        $instructors = SkiInstructor::with('user')->get();
        return view('team', compact('instructors'));
    }

    public function webShow(SkiInstructor $skiInstructor)
    {
        $instructor = $skiInstructor->load('user'); // Debugging line, remove in production
        return view('instructor', compact('instructor'));
    }

    private function createInstructorUser(string $name, string $email, ?string $phone = null): User
    {
        // Check if user with this email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            throw new \InvalidArgumentException("A user with email '{$email}' already exists. Please use a different email address or select the existing user from the dropdown.");
        }

        $temporaryPassword = Str::random(12);

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($temporaryPassword),
            'must_change_password' => true,
        ];

        if ($phone) {
            $userData['phone'] = $phone;
        }

        $user = User::create($userData);

        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $user->assignRole($instructorRole);

        $loginUrl = url('/admin/login');
        $user->notify(new InstructorInvitation($temporaryPassword, $loginUrl));

        return $user;
    }
}
