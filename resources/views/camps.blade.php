{{-- resources/views/camps.blade.php --}}
@php
use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')

@section('title', __('Camps'))
@section('subtitle', __('Explore Our Camps'))
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-40 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-4">
                    @include('partials.contact-form')
                </div>
                <div class="col-lg-8">
                    <div class="row row-30 row-xl-40">
                        @foreach($camps as $camp)
                            <div class="col-sm-6">
                                <article class="tour-classic camp-listing-card">
                                    <div class="tour-classic-media">
                                        <a class="tour-classic-figure" href="{{ localized_route('camps.show', $camp->getTranslation('slug', app()->getLocale())) }}">
                                            <img class="tour-classic-image" src="{{ Storage::disk('public')->url($camp->image_path) }}" alt="{{ $camp->getTranslation('title', app()->getLocale()) }}" width="365" height="248"/>
                                        </a>
                                        <div class="camp-listing-dates">
                                            {{ $camp->start_date->format('M d') }} - {{ $camp->end_date->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="tour-classic-body">
                                        <div class="camp-listing-title-row">
                                            <h4 class="tour-classic-title">
                                                <a href="{{ localized_route('camps.show', $camp->getTranslation('slug', app()->getLocale())) }}">{{ $camp->getTranslation('title', app()->getLocale()) }}</a>
                                            </h4>
                                            <div class="camp-listing-age">
                                                <span class="icon mdi mdi-account-group"></span>
                                                <span>{{ $camp->getTranslation('age_condition', app()->getLocale()) }}</span>
                                            </div>
                                        </div>
                                        <div class="camp-listing-info">
                                            <div class="camp-listing-detail">
                                                <span class="icon mdi mdi-map-marker"></span>
                                                <span>{{ $camp->getTranslation('location', app()->getLocale()) }}</span>
                                            </div>
                                            <div class="camp-listing-detail">
                                                <span class="icon mdi mdi-account-multiple"></span>
                                                <span>{{ $camp->capacity }} {{__('spots')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Camp Listing Styles */
    .camp-listing-card {
        position: relative;
    }

    .camp-listing-dates {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 6px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        color: #333;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 2;
    }

    .camp-listing-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        gap: 10px;
    }

    .camp-listing-age {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #666;
        white-space: nowrap;
    }

    .camp-listing-age .icon {
        font-size: 14px;
        margin-right: 4px;
        color: #2196F3;
    }

    .camp-listing-info {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 10px;
    }

    .camp-listing-detail {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #666;
    }

    .camp-listing-detail .icon {
        font-size: 16px;
        margin-right: 6px;
        color: #2196F3;
    }

    @media (max-width: 767px) {
        .camp-listing-dates {
            font-size: 11px;
            padding: 5px 8px;
        }

        .camp-listing-info {
            flex-direction: column;
            gap: 8px;
        }

        .camp-listing-detail {
            font-size: 13px;
        }
    }
</style>
@endpush
