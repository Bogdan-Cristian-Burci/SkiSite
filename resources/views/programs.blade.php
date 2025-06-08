{{-- resources/views/programs.blade.php --}}
@extends('layouts.app')

@section('title', __('Programs'))
@section('subtitle', __('Explore Our Programs'))
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-40 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-4">
                    @include('partials.appointment-form')
                </div>
                <div class="col-lg-8">
                    <div class="row row-30 row-xl-40">
                        @foreach($programs as $program)
                            <div class="col-sm-6">
                                <article class="tour-classic">
                                    <div class="tour-classic-media">
                                        <a class="tour-classic-figure" href="{{ localized_route('programs.show', ['slug' => $program->getTranslation('slug', app()->getLocale())]) }}">
                                            <img class="tour-classic-image" src="{{ asset('storage/'.$program->image_path) }}" alt="" width="365" height="248"/>
                                        </a>
                                    </div>
                                    <div class="tour-classic-body">
                                        <h4 class="tour-classic-title">
                                            <a href="{{ localized_route('programs.show', ['slug' => $program->getTranslation('slug', app()->getLocale())]) }}">{{ $program->title }}</a>
                                        </h4>
                                        <p class="tour-classic-caption">{{ $program->description }}</p>
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
