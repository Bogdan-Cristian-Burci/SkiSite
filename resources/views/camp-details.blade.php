{{-- resources/views/camp-details.blade.php --}}
@php
use Illuminate\Support\Facades\Storage;
@endphp
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
                            <img src="{{ Storage::disk('public')->url($camp->image_path) }}" alt="{{ $camp->getTranslation('title', app()->getLocale()) }}" class="img-fluid rounded" style="width: 100%; height: 400px; object-fit: cover;">
                        </div>

                        <!-- Camp Info Table and Map -->
                        <div class="row mb-4">
                            <div class="col-lg-9">
                                <table class="post-info-table">
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Capacity') }}</td>
                                        <td>
                                            <span class="icon mdi mdi-account-multiple"></span>
                                            <strong>{{ $availableSpots }}</strong> {{ __('spots available') }}
                                            <br>
                                            <small class="text-muted">{{ $takenSpots }}/{{ $camp->capacity }} {{ __('taken') }}</small>
                                            @if($availableSpots <= 5 && $availableSpots > 0)
                                                <br><small class="text-warning">
                                                    <i class="mdi mdi-alert-outline"></i>
                                                    {{ __('Only few spots left!') }}
                                                </small>
                                            @elseif($availableSpots == 0)
                                                <br><small class="text-danger">
                                                    <i class="mdi mdi-close-circle-outline"></i>
                                                    {{ __('Camp is full!') }}
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @if($camp->latitude && $camp->longitude)
                                <div class="col-lg-3">
                                    <div class="camp-map-container">
                                        <div id="campMap" class="camp-map"></div>
                                    </div>
                                </div>
                            @endif
                        </div>

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

                        <!-- Camp Registration Form -->
                        <div class="camp-registration-section mt-4">
                            @include('partials.camp-registration-form', [
                                'camp' => $camp,
                                'userRegistration' => $userRegistration,
                                'takenSpots' => $takenSpots,
                                'availableSpots' => $availableSpots
                            ])
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

    .camp-map-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .camp-map {
        width: 100%;
        height: 100%;
        min-height: 350px;
    }

    @media (max-width: 991px) {
        .camp-map {
            height: 300px;
            margin-top: 20px;
            min-height: 300px;
        }
    }
</style>
@endpush

@if($camp->latitude && $camp->longitude)
@push('scripts')
<script>
function initCampMap() {
    // Camp coordinates
    const campLocation = {
        lat: {{ $camp->latitude }},
        lng: {{ $camp->longitude }}
    };

    // Initialize the map
    const map = new google.maps.Map(document.getElementById("campMap"), {
        zoom: 13,
        center: campLocation,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: true,
        navigationControl: true,
        mapTypeControl: false,
        scaleControl: true,
        draggable: true,
        styles: [
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#d3d3d3"
                    }
                ]
            },
            {
                "featureType": "transit",
                "stylers": [
                    {
                        "color": "#808080"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#b3b3b3"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ffffff"
                    },
                    {
                        "weight": 1.8
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#d7d7d7"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ebebeb"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#a7a7a7"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#efefef"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#696969"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#737373"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#d6d6d6"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {},
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#dadada"
                    }
                ]
            }
        ]
    });

    // Create a custom marker
    const marker = new google.maps.Marker({
        position: campLocation,
        map: map,
        title: "{{ $camp->getTranslation('title', app()->getLocale()) }}",
        animation: google.maps.Animation.DROP,
        icon: {
            url: '/images/gmap_marker.png',
            scaledSize: new google.maps.Size(30, 30),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(15, 30)
        }
    });

    // Create info window
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 10px; max-width: 200px;">
                <h6 style="margin: 0 0 5px 0; color: #333;">{{ $camp->getTranslation('title', app()->getLocale()) }}</h6>
                <p style="margin: 0; font-size: 12px; color: #666;">{{ $camp->getTranslation('location', app()->getLocale()) }}</p>
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #888;">
                    {{ $camp->start_date->format('M d') }} - {{ $camp->end_date->format('M d, Y') }}
                </p>
            </div>
        `
    });

    // Show info window on marker click
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });

    // Auto-open info window after a short delay
    setTimeout(function() {
        infoWindow.open(map, marker);
    }, 1000);
}

// Initialize map when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Check if Google Maps is loaded
    if (typeof google !== 'undefined' && google.maps) {
        initCampMap();
    } else {
        // Load Google Maps API if not already loaded
        const script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBPTmXj4ZBaVTS4rvEVgFzTMeIcbvT24q0&callback=initCampMap';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
});
</script>
@endpush
@endif
