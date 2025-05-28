{{-- resources/views/instructor.blade.php --}}
@extends('layouts.app')

@section('title', $instructor->user->name ?? 'Instructor')

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-gray-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <img src="{{ asset($instructor->image_path) }}" alt="{{ $instructor->user->name ?? 'Instructor' }}" class="img-fluid mb-4" width="272" height="197">
                    <h2>{{ $instructor->user->name ?? 'Instructor' }}</h2>
                    <h5 class="text-muted">{{ $instructor->position }}</h5>
                    <p>{{ $instructor->bio }}</p>
                    @if($instructor->user && $instructor->user->phone)
                        <div>
                            <a href="tel:{{ $instructor->user->phone }}" class="btn btn-primary mt-3">{{ __('Call') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
