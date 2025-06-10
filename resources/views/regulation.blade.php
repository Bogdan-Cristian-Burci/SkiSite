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
                    <div class="regulation-item">
                        <h4 class="mb-3">
                            <a href="{{ localized_route('regulations.show', ['slug' => $regulation->getTranslation('slug', app()->getLocale())]) }}"
                               class="text-decoration-none">
                                {{ $regulation->getTranslation('title', app()->getLocale()) }}
                            </a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
