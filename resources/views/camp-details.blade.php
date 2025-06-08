{{-- resources/views/camp-details.blade.php --}}
@extends('layouts.app')

@section('title', $camp->getTranslation('title', app()->getLocale()) ?? __('Camp Details'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-40 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-12">
                    <article class="w-full">
                        <h3 class="post-info-title mb-2">{{ $camp->getTranslation('title', app()->getLocale()) }}</h3>

                        <!-- Camp Hero Image -->
                        <div class="camp-hero-image mb-4">
                            <img src="{{ asset('storage/' . $camp->image_path) }}" alt="{{ $camp->getTranslation('title', app()->getLocale()) }}" class="img-fluid rounded" style="width: 100%; height: 400px; object-fit: cover;">
                        </div>

                        <!-- Camp Info Table -->
                        <table class="post-info-table mb-4">
                            <tr>
                                <td>{{ __('Dates') }}</td>
                                <td>
                                    <strong>{{ $camp->start_date->format('F d, Y') }} - {{ $camp->end_date->format('F d, Y') }}</strong>
                                    <br>
                                    <small class="text-muted">({{ $camp->start_date->diffInDays($camp->end_date) + 1 }} days)</small>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Age Condition') }}</td>
                                <td>
                                    <span class="icon mdi mdi-account-group"></span>
                                    {{ $camp->getTranslation('age_condition', app()->getLocale()) }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Location') }}</td>
                                <td>
                                    <span class="icon mdi mdi-map-marker"></span>
                                    {{ $camp->getTranslation('location', app()->getLocale()) }}
                                    @if($camp->latitude && $camp->longitude)
                                        <a href="https://maps.google.com/?q={{ $camp->latitude }},{{ $camp->longitude }}" target="_blank" class="ml-2">
                                            <small>({{ __('View on Map') }})</small>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Capacity') }}</td>
                                <td>
                                    <span class="icon mdi mdi-account-multiple"></span>
                                    {{ $camp->capacity }} {{ __('spots available') }}
                                </td>
                            </tr>
                        </table>

                        <!-- Price Information -->
                        @if($camp->getTranslation('price_info', app()->getLocale()))
                            <div class="camp-section">
                                <h4>{{ __('Price Information') }}</h4>
                                <div class="camp-content">
                                    {!! html_entity_decode($camp->getTranslation('price_info', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                        @endif

                        <!-- Transport Information -->
                        @if($camp->getTranslation('transport_info', app()->getLocale()))
                            <div class="camp-section">
                                <h4>{{ __('Transport') }}</h4>
                                <div class="camp-content">
                                    {!! html_entity_decode($camp->getTranslation('transport_info', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                        @endif

                        <!-- Meal Information -->
                        @if($camp->getTranslation('meal_info', app()->getLocale()))
                            <div class="camp-section">
                                <h4>{{ __('Meals') }}</h4>
                                <div class="camp-content">
                                    {!! html_entity_decode($camp->getTranslation('meal_info', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                        @endif

                        <!-- Accommodation Information -->
                        @if($camp->getTranslation('accommodation_info', app()->getLocale()))
                            <div class="camp-section">
                                <h4>{{ __('Accommodation') }}</h4>
                                <div class="camp-content">
                                    {!! html_entity_decode($camp->getTranslation('accommodation_info', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                        @endif

                        <!-- Article Content -->
                        @if($camp->getTranslation('article_content', app()->getLocale()))
                            <div class="camp-section">
                                <h4>{{ __('Details') }}</h4>
                                <div class="camp-content">
                                    {!! html_entity_decode($camp->getTranslation('article_content', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                        @endif

                        <!-- Book Now Button -->
                        <div class="text-center mt-4">
                            @auth
                                <form action="{{ route('camps.book', $camp->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="button button-lg button-primary">
                                        {{ __('Book This Camp') }}
                                    </button>
                                </form>
                            @else
                                <div class="booking-message mb-3">
                                    <p class="text-muted mb-2">{{ __('If you want to book this camp, please login.') }}</p>
                                </div>
                                <a href="{{ localized_route('login') }}" class="button button-lg button-secondary">
                                    {{ __('Login to Book') }}
                                </a>
                            @endauth
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .camp-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }

    .camp-section:last-child {
        border-bottom: none;
    }

    .camp-section h4 {
        color: #333;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .camp-content {
        color: #666;
        line-height: 1.6;
    }

    .post-info-table td .icon {
        color: #2196F3;
        margin-right: 8px;
        font-size: 16px;
    }

    .camp-hero-image {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
