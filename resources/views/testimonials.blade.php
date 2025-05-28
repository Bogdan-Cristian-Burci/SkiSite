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
                <div class="col-md-6">
                    <blockquote class="quote-classic">
                        <div class="quote-classic-inner">
                            <div class="quote-classic-header">
                                <div class="quote-classic-profile">
                                    <img class="quote-classic-avatar" src="{{ asset('images/testimonials-2-84x84.png') }}" alt="" width="84" height="84"/>
                                    <cite class="quote-classic-cite heading-4">John Smith</cite>
                                </div>
                                <div class="quote-classic-links">
                                    <a class="quote-classic-social-link mdi mdi-facebook" href="#"></a>
                                </div>
                            </div>
                            <div class="quote-classic-text">
                                <p>Cur brabeuta trabem? Ecce, resistentia! Ionicis tormento accelerares, tanquam fidelis saga. Paluss sunt extums de magnum homo!</p>
                            </div>
                            <time class="quote-classic-time" datetime="2020">Mar 21, 2020</time>
                        </div>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="quote-classic">
                        <div class="quote-classic-inner">
                            <div class="quote-classic-header">
                                <div class="quote-classic-profile">
                                    <img class="quote-classic-avatar" src="{{ asset('images/testimonials-1-84x84.png') }}" alt="" width="84" height="84"/>
                                    <cite class="quote-classic-cite heading-4">Peter McMillan</cite>
                                </div>
                                <div class="quote-classic-links">
                                    <a class="quote-classic-social-link mdi mdi-facebook" href="#"></a>
                                </div>
                            </div>
                            <div class="quote-classic-text">
                                <p>Nunquam tractare impositio. Tuss tolerare in burdigala! Cum onus prarere, omnes seculaes tractare lotus, gratis mensaes.</p>
                            </div>
                            <time class="quote-classic-time" datetime="2020">Mar 21, 2020</time>
                        </div>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="quote-classic">
                        <div class="quote-classic-inner">
                            <div class="quote-classic-header">
                                <div class="quote-classic-profile">
                                    <img class="quote-classic-avatar" src="{{ asset('images/testimonials-3-84x84.png') }}" alt="" width="84" height="84"/>
                                    <cite class="quote-classic-cite heading-4">Sam Lee</cite>
                                </div>
                                <div class="quote-classic-links">
                                    <a class="quote-classic-social-link mdi mdi-facebook" href="#"></a>
                                </div>
                            </div>
                            <div class="quote-classic-text">
                                <p>Clabulares sunt omnias de bi-color urbs. Accola de germanus humani generis, tractare medicina! Raptus aususs ducunt ad hibrida.</p>
                            </div>
                            <time class="quote-classic-time" datetime="2020">Mar 21, 2020</time>
                        </div>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="quote-classic">
                        <div class="quote-classic-inner">
                            <div class="quote-classic-header">
                                <div class="quote-classic-profile">
                                    <img class="quote-classic-avatar" src="{{ asset('images/testimonials-4-84x84.jpg') }}" alt="" width="84" height="84"/>
                                    <cite class="quote-classic-cite heading-4">Kate Wilson</cite>
                                </div>
                                <div class="quote-classic-links">
                                    <a class="quote-classic-social-link mdi mdi-facebook" href="#"></a>
                                </div>
                            </div>
                            <div class="quote-classic-text">
                                <p>Peritus turpiss ducunt ad urbs. Hercle, consilium germanus!. Cum tabes accelerare, omnes eposes fallere ferox, secundus adgiumes!</p>
                            </div>
                            <time class="quote-classic-time" datetime="2020">Mar 21, 2020</time>
                        </div>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
@endsection
