{{-- resources/views/pricing.blade.php --}}
@extends('layouts.app')

@section('title', __('Pricing'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default text-center">
        <div class="container">
            <h3 class="wow fadeIn">{{ __('Pricing') }}</h3>
        </div>
        <div class="tabs-custom tabs-horizontal tabs-modern" id="tabs-1">
            <!--Nav tabs-->
            <ul class="nav nav-tabs nav-modern">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="#tabs-1-1" data-toggle="tab">{{ __('Kids') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="#tabs-1-2" data-toggle="tab">{{ __('Adults') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="#tabs-1-3" data-toggle="tab">{{ __('Corporate') }}</a>
                </li>
            </ul>
            <!--Tab panes-->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabs-1-1">
                    <div class="container">
                        <div class="row row-30 row-narrow-80">
                            <!-- Example static pricing cards, replace with dynamic data as needed -->
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-1-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Group skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-2-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Individual skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-3-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Intermediate skiing classes (group only)') }}</a>
                                    </p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-1-2">
                    <div class="container">
                        <div class="row row-30 row-narrow-80">
                            <!-- Repeat or load dynamic pricing for Adults -->
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-3-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Intermediate skiing classes (group only)') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-2-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Individual skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-1-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Group skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-1-3">
                    <div class="container">
                        <div class="row row-30 row-narrow-80">
                            <!-- Repeat or load dynamic pricing for Corporate -->
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-2-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Individual skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-1-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Group skiing classes for beginners') }}</a>
                                    </p>
                                </article>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <article class="post-classic">
                                    <a class="post-classic-figure" href="#">
                                        <img class="post-classic-image" src="{{ asset('images/grid-blog-3-339x251.jpg') }}" alt="" width="339" height="251"/>
                                    </a>
                                    <span class="price tour-price">{{ __('From $45/day') }}</span>
                                    <div class="post-classic-divider"></div>
                                    <p class="heading-4 post-classic-title">
                                        <a href="#">{{ __('Intermediate skiing classes (group only)') }}</a>
                                    </p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
