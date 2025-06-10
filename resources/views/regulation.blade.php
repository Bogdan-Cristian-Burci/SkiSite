@extends('layouts.app')

@section('title', __('Regulations'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <h3 class="wow fadeIn mb-4">{{ __('Regulations') }}</h3>
            <div class="regulations-list">
                @foreach($regulations as $regulation)
                    <div class="regulation-item mb-4 p-4 border rounded">
                        <h4 class="mb-3">
                            <a href="{{ localized_route('regulations.show', ['slug' => $regulation->getTranslation('slug', app()->getLocale())]) }}" 
                               class="text-decoration-none">
                                {{ $regulation->getTranslation('title', app()->getLocale()) }}
                            </a>
                        </h4>
                        @if($regulation->getTranslation('subtitle', app()->getLocale()))
                            <p class="text-muted mb-3">{{ $regulation->getTranslation('subtitle', app()->getLocale()) }}</p>
                        @endif
                        <div class="regulation-excerpt">
                            {!! Str::limit(strip_tags($regulation->getTranslation('content', app()->getLocale())), 200) !!}
                        </div>
                        <a href="{{ localized_route('regulations.show', ['slug' => $regulation->getTranslation('slug', app()->getLocale())]) }}" 
                           class="btn btn-primary btn-sm mt-3">
                            {{ __('Read More') }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
