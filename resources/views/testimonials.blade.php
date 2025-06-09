{{-- resources/views/testimonials.blade.php --}}
@extends('layouts.app')

@section('title', __('Testimonials'))
@section('subtitle', __('What Our Clients Say'))
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row row-30 row-md-50 justify-content-center justify-content-lg-start">
                @foreach($testimonials as $testimonial)
                    <div class="col-md-6">
                        <blockquote class="quote-classic">
                            <div class="quote-classic-inner">
                                <div class="quote-classic-header">
                                    <div class="quote-classic-profile">
                                        <cite class="quote-classic-cite heading-4">{{ $testimonial->author_name }}</cite>
                                    </div>
                                </div>
                                <div class="quote-classic-text">
                                    <p>{{ $testimonial->content }}</p>
                                </div>
                                <time class="quote-classic-time" datetime="{{ $testimonial->created_at }}">{{ $testimonial->created_at }}</time>
                            </div>
                        </blockquote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
