{{-- resources/views/about.blade.php --}}
@php
use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')

@section('title', __('About'))
@section('subtitle', __('Learn More About Us'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-sm bg-default">
        <div class="container">
            <div class="row row-50 justify-content-center align-items-center justify-content-xl-around">
                <div class="col-md-10 col-lg-6">
                    @if($company && $company->about_title)
                        <h3>{{ $company->about_title }}</h3>
                    @endif

                    <div class="block-2 mt-20 mt-md-30 mt-lg-50">
                        @if($company && $company->about_content)
                            {!! $company->about_content !!}
                        @endif
                    </div>
                    <a class="button-square btn-md button button-primary mt-lg-40" href="{{ localized_route('contact') }}">{{ __('Book Now') }}</a>
                </div>
                <div class="col-md-10 col-lg-5">
                    <figure class="figure-1" role="presentation">
                        @if($company && $company->about_image_path)
                            <img src="{{ Storage::disk('public')->url($company->about_image_path) }}" alt="{{ $company->about_title ?? __('About Us') }}" width="461" height="450"/>
                        @else
                            <img src="{{ asset('images/about-1-461x450.png') }}" alt="" width="461" height="450"/>
                        @endif
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-gray-100 text-center text-sm-left">
        <div class="container">
            <ul class="list-group-1 row row-50">
                @if($whyChooseUs && $whyChooseUs->count() > 0)
                    @foreach($whyChooseUs as $item)
                        <li class="col-sm-6 col-lg-3">
                            <article class="lg-1-item">
                                <div class="icon lg-1-item-icon {{ $item->icon }}"></div>
                                <div class="lg-1-item-main">
                                    <h4 class="lg-1-item-title">{{ $item->title }}</h4>
                                    <p>{{ $item->subtitle }}</p>
                                </div>
                            </article>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="range">
            <div class="cell-lg-7 cell-xl-8 cell-xxl-9">
                <div class="cell-inner section-lg text-center text-sm-left">
                    <h3>{{ __("Meet Our Team") }}</h3>
                    <p>{{ __('Meet Our Team subtitle') }}</p>
                    <div class="owl-carousel owl-1 mt-lg-50" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="2" data-xl-items="3" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="30" data-mouse-drag="false">
                        @foreach($team as $member)
                            <a href="{{ localized_route('team.show', ['skiInstructor' => $member->slug]) }}" class="text-decoration-none text-reset">
                                <article class="profile-classic">
                                    <img class="profile-classic-image" src="{{ Storage::disk('public')->url($member->image_path) }}" alt="{{ $member->user->name ?? '' }}" width="272" height="197"/>
                                    <div class="profile-classic-main">
                                        <p class="heading-5 profile-classic-position">{{ $member->position }}</p>
                                        <p class="profile-classic-name heading-4">{{ $member->user->name ?? '' }}</p>
                                        @if($member->user->phone)
                                            <div class="profile-classic-unit">
                                                <div class="icon mdi mdi-phone"></div>
                                                <a class="heading-6" href="tel:{{ $member->user->phone ?? '' }}">{{ $member->user->phone ?? '' }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="cell-lg-5 cell-xl-4 cell-xxl-3 height-fill">
                <div class="box-3 bg-image" style="background-image: url({{ asset('images/about-2.jpg') }});"></div>
            </div>
        </div>
    </section>
@endsection
