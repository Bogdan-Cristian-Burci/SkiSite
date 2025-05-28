@extends('layouts.app')

@section('title', 'Home - SkiUp Ski School')
@section('meta_description', 'SkiUp ski school provides a variety of courses and activities for learners of any age and skill level. With us, you\'ll be skiing confidently in no time.')

@section('header')
    @include('partials.header-home')
@endsection

@section('hero-section')
    <div class="swiper-container swiper-slider swiper-slider-1 context-dark" data-loop="false" data-autoplay="4000" data-simulate-touch="false" data-slide-effect="fade" data-nav="true">
        <div class="swiper-wrapper">
            @foreach($heroSliders as $slider)
                <div class="swiper-slide" data-slide-bg="{{ $slider->image_path }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-7">
                                <div class="intro-box">
                                    <div class="intro-title">{{$slider->title}}</div>
                                    <div class="intro-caption">{{$slider->subtitle}}</div>
                                    <div class="floating-text">{{$slider->background_text}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--Swiper Pagination-->
        <div class="swiper-pagination"></div>
        <!--Swiper Navigation-->
        <div class="swiper-button-prev fa-arrow-left"></div>
        <div class="swiper-button-next fa-arrow-right"></div>
    </div>
@endsection

@section('content')
    <!-- Tours -->
    <section class="section section-custom-1 bg-default">
        <div class="container">
            <div class="row row-50 justify-content-xl-between flex-lg-row-reverse">
                <div class="col-lg-5 col-xl-5">
                    <div class="section-custom-1-block">
                        <div class="row row-40">
                            <div class="col-md-6 col-lg-12">
                                <h4 class="wow fadeIn font-weight-regular">Make an appointment</h4>
                                <!-- RD Mail form-->
                                <form class="rd-form rd-mailform form-lg" method="POST" action="{{ route('contact.store') }}">
                                    @csrf
                                    <div class="form-wrap form-wrap-icon wow fadeIn" data-wow-delay=".05s">
                                        <input class="form-input form-label-outside" id="login-name-2" type="text" name="name"/>
                                        <label class="form-label" for="login-name-2">Name</label>
                                        <div class="icon form-icon mdi mdi-account-outline"></div>
                                    </div>
                                    <div class="form-wrap form-wrap-icon wow fadeIn" data-wow-delay=".1s">
                                        <input class="form-input" id="contact-3-email" type="email" name="email" >
                                        <label class="form-label form-label-outside" for="contact-3-email">E-mail</label>
                                        <div class="icon form-icon mdi mdi-calendar-text"></div>
                                    </div>
                                    <div class="form-wrap form-wrap-icon wow fadeIn" data-wow-delay=".15s">
                                        <input class="form-input" id="contact-3-phone" type="text" name="phone" >
                                        <label class="form-label" for="contact-3-phone">Phone</label>
                                        <div class="icon form-icon mdi mdi-account-multiple"></div>
                                    </div>
                                    <div class="form-element wow fadeIn" data-wow-delay=".2s">
                                        <button class="button button-lg button-primary btn-lg" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="box-call">
                                    <div class="heading-4">Do you need help?</div>
                                    <p>Watch this presentation to know more about us.</p>
                                    <div class="info-group"><span class="icon mdi mdi-phone"></span><a href="tel:{{ config('site.phone', '1-800-346-6277') }}">{{ config('site.phone', '1-800-346-6277') }}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="inset-4">
                        <div class="layout-2 wow fadeIn">
                            <h3>{{__('What we offer')}}</h3>
                            <div class="layout-2-item"><a class="button button-sm button-style-1 button-square" href="{{ localized_route('programs') }}">{{__("View All")}}</a></div>
                        </div>
                        <div class="row row-30 mt-xl-60">
                            @foreach($skiPrograms as $skiProgram)
                                <div class="col-xs-6 col-sm-6 wow fadeIn" data-wow-delay="{{ $loop->index * 0.05 }}s">
                                    <article class="tour-minimal context-dark">
                                        <div class="tour-minimal-inner" style="background-image: url({{ asset($skiProgram->image_path) }});">
                                            <div class="tour-minimal-header">
                                            </div>
                                            <div class="tour-minimal-main">
                                                <h4 class="tour-minimal-title"><a href="{{ localized_route('programs.show', $skiProgram->getTranslation('slug', app()->getLocale()) ?: $skiProgram->id) }}">{{ $skiProgram->title }}</a></h4>
                                            </div>
                                            <div class="tour-minimal-caption">
                                                <p >{{ $skiProgram->description }}</p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Tours-->
    <section class="section section-1 bg-gray-100">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-8">
                    <h3 class="text-center text-sm-left">Recent News Posts</h3>
                    <article class="tour-modern mt-30 mt-xl-60 wow fadeIn" data-wow-delay=".05s">
                        <div class="tour-modern-media">
                            <a class="tour-modern-figure" href="{{ localized_route('blog.show', 1) }}">
                                <img class="tour-modern-image" src="{{ asset('images/post-1-358x450.jpg') }}" alt="" width="358" height="450"/>
                            </a>
                        </div>
                        <div class="tour-modern-main">
                            <h4 class="tour-modern-title"><a href="{{ localized_route('blog.show', 1) }}">Top 5 Secret Tips for Advanced Skiers of All Ages</a></h4>
                            <div class="tour-modern-info">
                                <p class="tour-modern-tag">news</p>
                            </div>
                            <p>Whether you're a beginner or an expert, these insider tips are the savvy skier or snowboarder's way to give skills a boost and enjoy every minute of slope time, without booking a week...</p>
                        </div>
                    </article>
                    <article class="tour-modern wow fadeIn" data-wow-delay=".1s">
                        <div class="tour-modern-media">
                            <a class="tour-modern-figure" href="{{ localized_route('blog.show', 2) }}">
                                <img class="tour-modern-image" src="{{ asset('images/post-2-358x450.jpg') }}" alt="" width="358" height="450"/>
                            </a>
                        </div>
                        <div class="tour-modern-main">
                            <h4 class="tour-modern-title"><a href="{{ localized_route('blog.show', 2) }}">Where to Ski This Winter: 5 Best Locations</a></h4>
                            <div class="tour-modern-info">
                                <p class="tour-modern-tag">news</p>
                            </div>
                            <p>When it comes to skiing and general fun on the snow, there is no single country that adequately emerges as the best. Each comes with its own upsides dishing out experiences to...</p>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="row row-40 row-md-50 row-xxl-80">
                        <div class="col-md-6 col-lg-12">
                            <h3 class="text-center text-sm-left wow fadeIn">Popular Destinations</h3>
                            <article class="box-8 mt-30 mt-xl-60 wow fadeIn" data-wow-delay=".1s">
                                <ul class="list-marked__creative">
                                    <li><a href="#">Equipment Storage</a></li>
                                    <li><a href="#">Complimentary Transfers</a></li>
                                    <li><a href="#">Corporate Courses</a></li>
                                    <li><a href="#">Gear Rental</a></li>
                                </ul>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <h3 class="text-center text-sm-left wow fadeIn">Why choose us</h3>
                            <ul class="row list-group-2 row-20 row-md-30 mt-30 mt-xl-50 advantages-list">
                                <li class="col-sm-6 col-md-12 wow fadeIn" data-wow-delay=".05s">
                                    <article class="lg-2-item">
                                        <span class="icon linearicons-landscape"></span>
                                        <div class="lg-2-item-main">
                                            <h4 class="lg-2-item-title">Amazing Place</h4>
                                            <p>Our skiing school is situated in one of the top skiing locations.</p>
                                        </div>
                                    </article>
                                </li>
                                <li class="col-sm-6 col-md-12 wow fadeIn" data-wow-delay=".1s">
                                    <article class="lg-2-item">
                                        <span class="icon linearicons-users2"></span>
                                        <div class="lg-2-item-main">
                                            <h4 class="lg-2-item-title">Best Instructors</h4>
                                            <p>SkiUp is a team of qualified and friendly skiing instructors.</p>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our School-->
    <section class="section section-md section-md-1 bg-image bg-overlay-3 context-dark text-center" style="background-image: url({{ asset('images/bg-image-11.jpg') }});">
        <div class="container">
            <h2 class="text-1 mt-xl-40 wow fadeIn" data-wow-delay=".025s">Join Our School</h2>
            <p class="block-8 mt-20 mt-xl-30 wow fadeIn" data-wow-delay=".05s">Looking for a place to hone your skiing skills? Join SkiUp to discover the best skiing lessons in the USA. Whether you prefer to learn to ski alone or in a group, we have what you need.</p>
            <a class="button button-white-inverse btn-md mt-xl-40 wow fadeIn" href="{{ localized_route('contact') }}" data-wow-delay=".075s">Join Now</a>
        </div>
    </section>

    <!-- Camps-->
    <section class="section section-lg bg-default text-center">
        <div class="container">
            <div class="layout-2 wow fadeIn">
                <h3>{{__('Camps')}}</h3>
                <div class="layout-2-item"><a class="button button-sm button-style-1 button-square" href="{{ localized_route('camps') }}">{{__("View All")}}</a></div>
            </div>
        </div>
        <div class="container">
            <div class="row row-30 row-narrow-80">
                @foreach($camps as $camp)
                    <div class="col-sm-6 col-lg-4 wow fadeIn" data-wow-delay="{{ $loop->index * 0.05 }}s">
                        <article class="post-classic camp-card">
                            <a class="post-classic-figure" href="{{ localized_route('camps.show', $camp->getTranslation('slug', app()->getLocale())) }}">
                                <img class="post-classic-image" src="{{ asset('storage/' . $camp->image_path) }}" alt="{{ $camp->getTranslation('title', app()->getLocale()) }}" width="339" height="251">
                            </a>
                            <div class="post-classic-divider"></div>
                            <div class="camp-card-content">
                                <div class="camp-dates">
                                    {{ $camp->start_date->format('M d') }} - {{ $camp->end_date->format('M d, Y') }}
                                </div>
                                <div class="camp-title-row">
                                    <h4 class="post-classic-title">
                                        <a href="{{ localized_route('camps.show', $camp->getTranslation('slug', app()->getLocale())) }}">{{ $camp->getTranslation('title', app()->getLocale()) }}</a>
                                    </h4>
                                    <div class="camp-age">
                                        <span class="icon mdi mdi-account-group"></span>
                                        <span class="camp-age-text">{{ $camp->getTranslation('age_condition', app()->getLocale()) }}</span>
                                    </div>
                                </div>
                                <div class="camp-location-capacity">
                                    <div class="camp-detail-item">
                                        <span class="icon mdi mdi-map-marker"></span>
                                        <span class="camp-detail-text">{{ $camp->getTranslation('location', app()->getLocale()) }}</span>
                                    </div>
                                    <div class="camp-detail-item">
                                        <span class="icon mdi mdi-account-multiple"></span>
                                        <span class="camp-detail-text">{{$camp->capacity}} spots</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- What Our Clients Say-->
    <section class="section section-lg bg-gray-100 text-center">
        <div class="container">
            <h3 class="ls-02 wow fadeIn">What Our Clients Say</h3>
            <p class="block-9 text-gray-500 wow fadeIn" data-wow-delay=".025s">These testimonials written by our regular clients are the best way to find out more about SkiUp's level of service and expertise.</p>
            <!-- Testimonials slider -->
            <div class="slick-slider slick-slider-1" data-loop="true" data-autoplay="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="3" data-lg-items="3" data-xl-items="3" data-center-mode="true" data-speed="600">
                <!-- Testimonial items -->
            </div>
        </div>
    </section>

    <!-- Get in Touch-->
    <section class="section section-lg">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-8">
                    <h3 class="wow fadeIn">Get in Touch</h3>
                    <article class="box-7 mt-md-45 mt-xxl-70 wow fadeIn bg-gray-100" data-wow-delay=".05s">
                        <!-- Contact form -->
                        <form class="rd-form rd-mailform form-lg" method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row row-30">
                                <div class="col-md-6">
                                    <div class="form-wrap form-wrap-icon">
                                        <input class="form-input" id="contact-name" type="text" name="name"/>
                                        <label class="form-label" for="contact-name">Name</label>
                                        <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap form-wrap-icon">
                                        <input class="form-input" id="contact-email" type="email" name="email"/>
                                        <label class="form-label" for="contact-email">E-mail</label>
                                        <div class="icon form-icon mdi mdi-email-outline text-primary"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap form-wrap-icon">
                                        <label class="form-label" for="contact-message">Message</label>
                                        <textarea class="form-input" id="contact-message" name="message"></textarea>
                                        <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrap form-wrap-button">
                                <button class="button button-lg button-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </article>
                </div>
                <div class="col-lg-4">
                    <h3 class="wow fadeIn">{{__("Instructors")}}</h3>
                    <div class="row row-30 row-md-50 mt-md-45 mt-xxl-70">
                        @foreach($skiInstructors as $skiInstructor)
                            <div class="col-sm-6 col-lg-12 wow fadeIn" data-wow-delay="{{ $loop->index * 0.05 }}s">
                                <!-- Profile Light-->
                                <article class="profile-light">
                                    <img class="profile-light-image" src="{{ asset($skiInstructor->image_path) }}" alt="{{$skiInstructor->user->name}}" style="width:95px;height:95px;border: 3px solid lightblue;"/>
                                    <div class="profile-light-main">
                                        <p class="profile-light-position">{{ $skiInstructor->position }}</p>
                                        <h5 class="profile-light-name">{{ $skiInstructor->user->name }}</h5>
                                    </div>
                                </article>
                            </div>

                        @endforeach
                        <div class="col-sm-6 col-lg-12 wow fadeIn" data-wow-delay=".15s">
                            <p class="text-accent mt-md-30 mt-xl-50">{{ config('site.address', '9 Valley St. Brooklyn, NY 11203') }}</p>
                            <article class="box-inline-1">
                                <span class="icon mdi mdi-phone"></span>
                                <a href="tel:{{ config('site.phone', '1-800-346-6277') }}">{{ config('site.phone', '1-800-346-6277') }}</a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <!-- Additional styles for the home page if needed -->
    <style>
        .ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;}
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}

        /* Camp Cards Styles */
        .camp-card {
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .camp-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .camp-card .post-classic-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .camp-card-content {
            padding: 15px 15px 20px;
            text-align: left;
        }

        .camp-dates {
            font-size: 13px;
            color: #2196F3;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .camp-title-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            gap: 10px;
        }

        .camp-age {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #666;
            white-space: nowrap;
        }

        .camp-age .icon {
            font-size: 14px;
            margin-right: 4px;
            color: #2196F3;
        }

        .camp-location-capacity {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .camp-detail-item {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
        }

        .camp-detail-item .icon {
            font-size: 16px;
            margin-right: 8px;
            color: #2196F3;
            min-width: 20px;
        }

        .camp-detail-text {
            flex: 1;
        }

        .camp-card .post-classic-title {
            margin-bottom: 0;
            font-size: 18px;
        }

        .camp-card .post-classic-title a {
            color: #333;
            text-decoration: none;
        }

        .camp-card .post-classic-title a:hover {
            color: #2196F3;
        }

        @media (max-width: 767px) {
            .camp-dates-badge {
                font-size: 11px;
                padding: 6px 10px;
            }

            .camp-card-content {
                padding: 15px 10px 20px;
            }

            .camp-detail-item {
                font-size: 13px;
            }
        }
    </style>
@endpush
