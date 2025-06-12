@php
use Illuminate\Support\Facades\Storage;
@endphp
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
                <div class="swiper-slide" data-slide-bg="{{ Storage::disk('public')->url($slider->image_path) }}">
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
                            <div class="col-md-12 col-lg-12">
                                @include('partials.appointment-form')
                            </div>
                            @if($company->phone)
                                <div class="col-md-12 col-lg-12">
                                    <div class="box-call">
                                        <div class="heading-4">{{__('Do you need help')}} ?</div>
                                        <p>{{__("You can call us at phone number written bellow or send us a message using our contact form")}}</p>
                                        <div class="info-group"><span class="icon mdi mdi-phone"></span><a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></div>
                                    </div>
                                </div>
                            @endif
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
                                        <div class="tour-minimal-inner" style="background-image: url({{ Storage::disk('public')->url($skiProgram->image_path) }});">
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
                    <h3 class="text-center text-sm-left">{{__("Recent News Posts")}}</h3>
                    @foreach($blogs as $blog)
                        <article class="tour-modern mt-30 mt-xl-60 wow fadeIn" data-wow-delay="{{ $loop->index * 0.05 }}s">
                            <div class="tour-modern-media">
                                <a class="tour-modern-figure" href="{{ localized_route('blog.show', $blog->getTranslation('slug', app()->getLocale()) ?: $blog->id) }}">
                                    <img class="tour-modern-image" src="{{ Storage::disk('public')->url($blog->image_path) }}" alt="{{$blog->getTranslation('title', app()->getLocale())}}" width="358" height="450"/>
                                </a>
                            </div>
                            <div class="tour-modern-main">
                                <h4 class="tour-modern-title"><a href="{{ localized_route('blog.show', $blog->getTranslation('slug', app()->getLocale()) ?: $blog->id) }}">{{$blog->title}}</a></h4>
                                <div class="tour-modern-info">
                                    <p class="tour-modern-tag">{{$blog->categories->name}}</p>
                                </div>
                                <p>{{$blog->subtitle}}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="col-lg-4">
                    <div class="row row-40 row-md-50 row-xxl-80">
                        <div class="col-md-6 col-lg-12">
                            @if($popularDestinations->count() > 0)
                                <h3 class="text-center text-sm-left wow fadeIn">{{ __('Popular Destinations') }}</h3>
                                <article class="box-8 mt-30 mt-xl-60 wow fadeIn" data-wow-delay=".1s">
                                    <ul class="list-marked__creative">
                                        @foreach($popularDestinations as $destination)
                                            <li><a href="{{ $destination->url }}">{{ $destination->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </article>
                            @endif
                        </div>
                        <div class="col-md-6 col-lg-12">
                            @if($whyChooseUs->count() > 0)
                                <h3 class="text-center text-sm-left wow fadeIn">{{__("Why choose us")}}</h3>
                                <ul class="row list-group-2 row-20 row-md-30 mt-30 mt-xl-50 advantages-list">
                                    @foreach($whyChooseUs as $index => $item)
                                        <li class="col-sm-6 col-md-12 wow fadeIn" data-wow-delay="{{ ($index + 1) * 0.05 }}s">
                                            <article class="lg-2-item">
                                                <span class="icon {{ $item->icon }}"></span>
                                                <div class="lg-2-item-main">
                                                    <h4 class="lg-2-item-title">{{ $item->title }}</h4>
                                                    <p>{{ $item->subtitle }}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our School-->
    @if($dividingSection)
        <section class="section section-md section-md-1 bg-image bg-overlay-3 context-dark text-center" style="background-image: url({{ Storage::disk('public')->url($dividingSection->image_path) }});">
            <div class="container">
                <h2 class="text-1 mt-xl-40 wow fadeIn" data-wow-delay=".025s">{{ $dividingSection->title }}</h2>
                <p class="block-8 mt-20 mt-xl-30 wow fadeIn" data-wow-delay=".05s">{{ $dividingSection->subtitle }}</p>
            </div>
        </section>
    @endif

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
                                <img class="post-classic-image" src="{{ Storage::disk('public')->url($camp->image_path) }}" alt="{{ $camp->getTranslation('title', app()->getLocale()) }}" width="339" height="251">
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
                                        <span class="camp-detail-text">{{$camp->capacity}} {{__('spots')}}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if($testimonials->count() > 0)
    <!-- What Our Clients Say-->
    <section class="section section-lg bg-gray-100 text-center">
        <div class="container">
            <h3 class="ls-02 wow fadeIn">{{__('What Our Clients Say')}}</h3>
            <p class="block-9 text-gray-500 wow fadeIn" data-wow-delay=".025s">{{__('What Our Clients Say content')}}.</p>
            <!-- Testimonials slider -->
            <div class="slick-slider slick-slider-1" data-loop="true" data-autoplay="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="3" data-lg-items="3" data-xl-items="3" data-center-mode="true" data-speed="600">
                <!-- Testimonial items -->
                @foreach($testimonials as $testimonial)
                    <div class="item">
                        <!-- Quote Classic-->
                        <blockquote class="quote-classic">
                            <div class="quote-classic-inner">
                                <div class="quote-classic-header">
                                    <div class="quote-classic-profile">
                                        <cite class="quote-classic-cite heading-4">{{$testimonial->author_name}}</cite>
                                    </div>
                                </div>
                                <div class="quote-classic-text">
                                    <p>{{$testimonial->content}}</p>
                                </div>
                                <time class="quote-classic-time" datetime="2020">{{$testimonial->created_at}}</time>
                            </div>
                        </blockquote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Get in Touch-->
    <section class="section section-lg">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-8">
                    <h3 class="wow fadeIn">{{ __('Get in Touch') }}</h3>
                    @include('partials.contact-form', [
                        'layout' => 'inline',
                        'title' => false,
                        'containerClass' => 'wow fadeIn',
                        'showSubject' => true,
                        'showCategory' => true,
                        'messageRows' => '4'
                    ])
                </div>
                <div class="col-lg-4">
                    <h3 class="wow fadeIn">{{__("Instructors")}}</h3>
                    <div class="row row-30 row-md-50 mt-md-45 mt-xxl-70">
                        @foreach($skiInstructors as $skiInstructor)
                            <div class="col-sm-6 col-lg-12 wow fadeIn" data-wow-delay="{{ $loop->index * 0.05 }}s">
                                <!-- Profile Light-->
                                <article class="profile-light">
                                    <img  src="{{ Storage::disk('public')->url($skiInstructor->image_path) }}" alt="{{$skiInstructor->user->name}}" style="width:95px;height:95px;border: 3px solid lightblue;object-fit:cover;border-radius:50%;"/>
                                    <div class="profile-light-main">
                                        <p class="profile-light-position">{{ $skiInstructor->position }}</p>
                                        <h5 class="profile-light-name">{{ $skiInstructor->user->name }}</h5>
                                    </div>
                                </article>
                            </div>

                        @endforeach
                        <div class="col-sm-6 col-lg-12 wow fadeIn" data-wow-delay=".15s">
                            <p class="text-accent mt-md-30 mt-xl-50">{{ $company->address }}</p>
                            <article class="box-inline-1">
                                <span class="icon mdi mdi-phone"></span>
                                <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Slick Slider initialization
$(document).ready(function() {
    $('.slick-slider').each(function() {
        var $this = $(this);
        var settings = {
            infinite: $this.data('loop') || false,
            autoplay: $this.data('autoplay') || false,
            dots: $this.data('dots') || false,
            swipeToSlide: $this.data('swipe') || false,
            slidesToShow: $this.data('items') || 1,
            slidesToScroll: 1,
            centerMode: $this.data('center-mode') || false,
            speed: $this.data('speed') || 300,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: $this.data('xl-items') || $this.data('items') || 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: $this.data('lg-items') || $this.data('items') || 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: $this.data('md-items') || $this.data('items') || 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: $this.data('sm-items') || $this.data('items') || 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: $this.data('xs-items') || $this.data('items') || 1
                    }
                }
            ]
        };
        
        $this.slick(settings);
    });
});

// Swiper fallback initialization
document.addEventListener('DOMContentLoaded', function() {
    // Function to set background images for slides
    function setSlideBackgrounds() {
        var slides = document.querySelectorAll('.swiper-slide[data-slide-bg]');
        slides.forEach(function(slide) {
            var bgUrl = slide.getAttribute('data-slide-bg');
            if (bgUrl) {
                slide.style.backgroundImage = 'url(' + bgUrl + ')';
                slide.style.backgroundSize = 'cover';
                slide.style.backgroundPosition = 'center';
                slide.style.backgroundRepeat = 'no-repeat';
            }
        });
    }

    // Set backgrounds immediately
    setSlideBackgrounds();

    // Wait for main script to initialize
    setTimeout(function() {
        var swiperContainer = document.querySelector('.swiper-container');

        if (swiperContainer && typeof Swiper !== 'undefined') {
            // Check if swiper is already initialized by the main script
            if (!swiperContainer.swiper) {
                // Use the HTML attributes to match original script behavior
                var container = swiperContainer;
                var swiper = new Swiper(container, {
                    loop: container.getAttribute('data-loop') === 'true',
                    effect: container.getAttribute('data-slide-effect') || 'fade',
                    autoplay: container.getAttribute('data-autoplay') ? {
                        delay: parseInt(container.getAttribute('data-autoplay')),
                        disableOnInteraction: container.getAttribute('data-simulate-touch') !== 'false',
                    } : false,
                    navigation: container.getAttribute('data-nav') === 'true' ? {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    } : false,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    simulateTouch: container.getAttribute('data-simulate-touch') === 'true',
                    on: {
                        init: function() {
                            setSlideBackgrounds();
                        }
                    }
                });
            } else {
                setSlideBackgrounds();
            }
        }
    }, 2000);
});
</script>
@endpush

@push('styles')
    <!-- Additional styles for the home page if needed -->
    <style>
        .ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;}
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}

        /* Camp Cards Styles */
        .camp-card {
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #EEF3F9;
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
