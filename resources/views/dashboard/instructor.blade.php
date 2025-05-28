@extends('layouts.app')

@section('title', 'Instructor Dashboard - ' . config('app.name'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
<section class="section section-lg bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>{{ __('Instructor Dashboard') }}</h1>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">{{ __('Logout') }}</button>
                    </form>
                </div>
                
                <div class="alert alert-info">
                    {{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }} 
                    {{ __('You can view and manage your appointments here.') }}
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('My Appointments') }}</h5>
                                <p class="card-text">{{ __('View and manage your upcoming appointments') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('View Appointments') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('My Profile') }}</h5>
                                <p class="card-text">{{ __('Update your instructor profile information') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Edit Profile') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Schedule') }}</h5>
                                <p class="card-text">{{ __('View your teaching schedule') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('View Schedule') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('Students') }}</h5>
                                <p class="card-text">{{ __('Manage your students') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('View Students') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection