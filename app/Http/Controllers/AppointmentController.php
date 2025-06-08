<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppoitmentRequest as AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCreatedAdmin;
use App\Mail\AppointmentCreatedUser;

class AppointmentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Appointment::class);

        $appointments = Appointment::with(['user', 'skiInstructor.user'])->get();
        return AppointmentResource::collection($appointments);
    }

    public function store(AppointmentRequest $request)
    {
        $this->authorize('create', Appointment::class);

        $data = $request->validated();
        $data['user_id'] = auth()->id();

        //Temporary add ski instructor ID for demo purposes
        if (isset($data['ski_instructor_id'])) {
            $data['ski_instructor_id'] = $data['ski_instructor_id'];
        } else {
            $data['ski_instructor_id'] = 1;
        }

        $appointment = Appointment::create($data);

        return new AppointmentResource($appointment->load(['user', 'skiInstructor.user']));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return new AppointmentResource($appointment->load(['user', 'skiInstructor.user']));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment->update($request->validated());

        return new AppointmentResource($appointment->load(['user', 'skiInstructor.user']));
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully']);
    }

    public function webCreate()
    {
        $instructors = \App\Models\SkiInstructor::with('user')->get();
        return view('appointments.create', compact('instructors'));
    }

    public function webStore(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $appointment = Appointment::create($data);
        $appointment->load('user');

        // Send email notifications
        try {
            // Send email to admin
            Mail::to(config('appointment.email.admin_email'))
                ->send(new AppointmentCreatedAdmin($appointment));

            // Send email to user
            Mail::to($appointment->user->email)
                ->send(new AppointmentCreatedUser($appointment));
        } catch (\Exception $e) {
            \Log::error('Failed to send appointment emails: ' . $e->getMessage());
        }

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment request submitted successfully! We will contact you within ' . config('appointment.email.reply_time_hours', 24) . ' hours.',
                'appointment' => new AppointmentResource($appointment)
            ]);
        }

        return redirect()->back()->with('success', 'Appointment request submitted successfully! We will contact you within ' . config('appointment.email.reply_time_hours') . ' hours.');
    }
}
