{{-- resources/views/team.blade.php --}}
@php
use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')

@section('title', __('Our Team'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-gray-100">
        <div class="container">
            <div class="row row-50 justify-content-center">
                <div class="col-md-12">
                    <div class="row row-30">
                        @foreach($instructors as $instructor)
                            <div class="col-sm-4">
                                <a href="{{ localized_route('team.show', ['skiInstructor' => $instructor->slug]) }}" class="text-decoration-none text-reset">
                                    <article class="profile-classic">
                                        <img class="profile-classic-image" src="{{ Storage::disk('public')->url($instructor->image_path) }}" alt="{{ $instructor->user->name ?? '' }}" width="272" height="197"/>
                                        <div class="profile-classic-main">
                                            <p class="heading-5 profile-classic-position">{{ $instructor->position }}</p>
                                            <p class="profile-classic-name heading-4">{{ $instructor->user->name ?? '' }}</p>
                                            @if($instructor->user->phone)
                                                <div class="profile-classic-unit">
                                                    <div class="icon mdi mdi-phone"></div>
                                                    <a class="heading-6" href="tel:{{ $instructor->user->phone ?? '' }}">{{ $instructor->user->phone ?? '' }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </article>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
