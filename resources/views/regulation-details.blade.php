{{-- resources/views/regulation-details.blade.php --}}
@extends('layouts.app')

@section('title', $regulation->getTranslation('title', app()->getLocale()) ?? __('Regulation Details'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-40 row-xl-50">
                <div class="col-lg-12">
                    <article class="w-full">
                        <!-- Regulation Title -->
                        <h3 class="post-info-title mb-2">{{ $regulation->getTranslation('title', app()->getLocale()) }}</h3>

                        <!-- Regulation Subtitle -->
                        @if($regulation->getTranslation('subtitle', app()->getLocale()))
                            <p class="text-secondary mb-4 lead">
                                {{ $regulation->getTranslation('subtitle', app()->getLocale()) }}
                            </p>
                        @endif

                        <!-- Regulation Content -->
                        <div class="regulation-content">
                            <div class="content-section">
                                {!! html_entity_decode($regulation->getTranslation('content', app()->getLocale()), ENT_QUOTES, 'UTF-8') !!}
                            </div>
                        </div>

                        <!-- Back to Regulations Button -->
                        <div class="text-center mt-5">
                            <a href="{{ localized_route('regulations') }}" class="button button-md button-secondary">
                                <span class="icon mdi mdi-arrow-left"></span>
                                {{ __('Back to Regulations') }}
                            </a>
                        </div>

                        <!-- Related Regulations -->
                        @if(isset($relatedRegulations) && $relatedRegulations->count() > 0)
                            <div class="related-regulations mt-5">
                                <h4 class="mb-4">{{ __('Related Regulations') }}</h4>
                                <div class="row">
                                    @foreach($relatedRegulations as $relatedRegulation)
                                        <div class="col-md-6 mb-3">
                                            <div class="related-item">
                                                <h6>
                                                    <a href="{{ localized_route('regulations.show', ['slug' => $relatedRegulation->slug]) }}" class="text-primary">
                                                        {{ $relatedRegulation->getTranslation('title', app()->getLocale()) }}
                                                    </a>
                                                </h6>
                                                @if($relatedRegulation->getTranslation('subtitle', app()->getLocale()))
                                                    <p class="text-muted small mb-0">
                                                        {{ Str::limit($relatedRegulation->getTranslation('subtitle', app()->getLocale()), 100) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .regulation-meta {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #2196F3;
    }

    .meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .meta-item:last-child {
        margin-bottom: 0;
    }

    .meta-item .icon {
        color: #2196F3;
        margin-right: 8px;
        font-size: 16px;
    }

    .meta-label {
        font-weight: 600;
        margin-right: 0.5rem;
        color: #333;
    }

    .meta-value {
        color: #666;
    }

    .regulation-content {
        margin: 2rem 0;
    }

    .content-section {
        line-height: 1.8;
        color: #444;
        font-size: 1.1rem;
    }

    .content-section h1,
    .content-section h2,
    .content-section h3,
    .content-section h4,
    .content-section h5,
    .content-section h6 {
        color: #333;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .content-section h1:first-child,
    .content-section h2:first-child,
    .content-section h3:first-child,
    .content-section h4:first-child,
    .content-section h5:first-child,
    .content-section h6:first-child {
        margin-top: 0;
    }

    .content-section p {
        margin-bottom: 0;
    }

    .content-section ul,
    .content-section ol {

    }
        padding-left: 2rem;
    }

    .content-section li {
        margin-bottom: 0;
    }

    .content-section blockquote {
        background: #f8f9fa;
        border-left: 4px solid #2196F3;
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
    }

    .content-section table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
    }

    .content-section th,
    .content-section td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .content-section th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }

    .related-regulations {
        border-top: 2px solid #eee;
        padding-top: 2rem;
    }

    .related-item {
        background: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .related-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .related-item h6 a {
        text-decoration: none;
        color: #2196F3;
        font-weight: 600;
    }

    .related-item h6 a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .regulation-meta {
            padding: 1rem;
        }

        .meta-item {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .meta-item .icon {
            margin-bottom: 0.25rem;
        }

        .content-section {
            font-size: 1rem;
        }
    }
</style>
@endpush
