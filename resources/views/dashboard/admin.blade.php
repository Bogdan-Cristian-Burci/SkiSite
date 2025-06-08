@extends('layouts.app')

@section('title', 'Admin Dashboard - ' . config('app.name'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
<section class="section section-lg bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>{{ __('Admin Dashboard') }}</h1>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">{{ __('Logout') }}</button>
                    </form>
                </div>
                
                <div class="alert alert-success">
                    {{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }} 
                    {{ __('You have admin access to manage all site content.') }}
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Ski Programs') }}</h5>
                                <p class="card-text">{{ __('Manage ski programs and courses') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Blog Posts') }}</h5>
                                <p class="card-text">{{ __('Create and edit blog posts') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Instructors') }}</h5>
                                <p class="card-text">{{ __('Manage ski instructors') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Bookings') }}</h5>
                                <p class="card-text">{{ __('View and manage all bookings') }}</p>
                                <a href="#bookings" class="btn btn-primary">{{ __('View') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Gallery') }}</h5>
                                <p class="card-text">{{ __('Manage photo gallery') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Settings') }}</h5>
                                <p class="card-text">{{ __('Site configuration') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bookings Section -->
                <div id="bookings" class="mt-5">
                    <h2>{{ __('Bookings') }}</h2>
                    
                    <!-- Instructor Appointments -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h3>{{ __('Instructor Appointments') }}</h3>
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Date Range') }}</th>
                                            <th>{{ __('Adults') }}</th>
                                            <th>{{ __('Children') }}</th>
                                            <th>{{ __('Hours/Day') }}</th>
                                            <th>{{ __('Instructor') }}</th>
                                            <th>{{ __('Created') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->user->name }}</td>
                                                <td>
                                                    {{ $appointment->start_date->format('Y-m-d') }}
                                                    @if($appointment->end_date)
                                                        - {{ $appointment->end_date->format('Y-m-d') }}
                                                    @endif
                                                </td>
                                                <td>{{ $appointment->number_of_adults }}</td>
                                                <td>{{ $appointment->number_of_children }}</td>
                                                <td>{{ $appointment->hours_per_day }}</td>
                                                <td>{{ $appointment->skiInstructor->name ?? __('Not assigned') }}</td>
                                                <td>{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ __('No appointments found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Camp Bookings -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <h3>{{ __('Camp Bookings') }} ({{ $campBookings->count() }})</h3>
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Camp') }}</th>
                                            <th>{{ __('Adults') }}</th>
                                            <th>{{ __('Children') }}</th>
                                            <th>{{ __('Camp Dates') }}</th>
                                            <th>{{ __('Booked On') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($campBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->getTranslation('title', app()->getLocale()) }}</td>
                                                <td>{{ $booking->pivot['number_of_adults'] }}</td>
                                                <td>{{ $booking->pivot['number_of_children'] }}</td>
                                                <td>{{ $booking->start_date->format('Y-m-d') }} - {{ $booking->end_date->format('Y-m-d') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($booking->pivot['created_at'])->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">{{ __('No camp bookings found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection