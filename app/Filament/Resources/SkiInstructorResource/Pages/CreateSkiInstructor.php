<?php

namespace App\Filament\Resources\SkiInstructorResource\Pages;

use App\Filament\Resources\SkiInstructorResource;
use App\Models\User;
use App\Notifications\InstructorInvitation;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class CreateSkiInstructor extends CreateRecord
{
    protected static string $resource = SkiInstructorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Handle user creation if instructor_name and instructor_email are provided
        if (!empty($data['instructor_name']) && !empty($data['instructor_email'])) {
            $user = $this->createInstructorUser($data['instructor_name'], $data['instructor_email']);
            $data['user_id'] = $user->id;
            $data['slug'] = Str::slug($data['instructor_name']);
        } elseif (!empty($data['user_id'])) {
            // Use existing user
            $user = User::findOrFail($data['user_id']);
            $data['slug'] = Str::slug($user->name);
        } else {
            throw new \InvalidArgumentException('Either instructor_name and instructor_email must be provided, or an existing user_id must be selected.');
        }

        // Remove instructor_name and instructor_email from data as they don't belong in ski_instructors table
        unset($data['instructor_name'], $data['instructor_email']);

        return $data;
    }

    private function createInstructorUser(string $name, string $email): User
    {
        // Check if user with this email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            throw new \InvalidArgumentException("A user with email '{$email}' already exists. Please use a different email address or select the existing user from the dropdown.");
        }

        $temporaryPassword = Str::random(12);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($temporaryPassword),
            'must_change_password' => true,
        ]);

        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $user->assignRole($instructorRole);

        $loginUrl = url('/admin/login');
        $user->notify(new InstructorInvitation($temporaryPassword, $loginUrl));

        return $user;
    }
}
