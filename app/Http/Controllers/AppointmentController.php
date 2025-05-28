<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        $data['user_id'] = auth()->id() ?? null; // Handle guest appointments
        
        $appointment = Appointment::create($data);
        
        return redirect()->back()->with('success', 'Appointment created successfully!');
    }
}
