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
                                <h5 class="card-title">{{ __('Appointments') }}</h5>
                                <p class="card-text">{{ __('View and manage appointments') }}</p>
                                <a href="#" class="btn btn-primary">{{ __('Manage') }}</a>
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
            </div>
        </div>
    </div>
</section>
@endsection