{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', __('About'))
@section('subtitle', __('Learn More About Us'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-sm bg-default">
        <div class="container">
            <div class="row row-50 justify-content-center align-items-center justify-content-xl-around">
                <div class="col-md-10 col-lg-6">
                    @if($company && $company->about_title)
                        <h3>{{ $company->about_title }}</h3>
                    @else
                        <h3>{{ __('Teaching Skiing Since 1999') }}</h3>
                    @endif
                    <div class="block-2 mt-20 mt-md-30 mt-lg-50">
                        @if($company && $company->about_content)
                            {!! $company->about_content !!}
                        @else
                            <p>{{ __('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.') }}</p>
                            <p>{{ __('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.') }}</p>
                        @endif
                    </div>
                    <a class="button-square btn-md button button-primary mt-lg-40" href="{{ localized_route('contact') }}">{{ __('Book Now') }}</a>
                </div>
                <div class="col-md-10 col-lg-5">
                    <figure class="figure-1" role="presentation">
                        @if($company && $company->about_image_path)
                            <img src="{{ asset('storage/'.$company->about_image_path) }}" alt="{{ $company->about_title ?? __('About Us') }}" width="461" height="450"/>
                        @else
                            <img src="{{ asset('images/about-1-461x450.png') }}" alt="" width="461" height="450"/>
                        @endif
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-gray-100 text-center text-sm-left">
        <div class="container">
            <ul class="list-group-1 row row-50">
                <li class="col-sm-6 col-lg-3">
                    <article class="lg-1-item">
                        <div class="icon lg-1-item-icon linearicons-users2"></div>
                        <div class="lg-1-item-main">
                            <h4 class="lg-1-item-title">Best Instructors</h4>
                            <p>{{ __('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.') }}</p>
                        </div>
                    </article>
                </li>
                <li class="col-sm-6 col-lg-3">
                    <article class="lg-1-item">
                        <div class="icon lg-1-item-icon linearicons-landscape"></div>
                        <div class="lg-1-item-main">
                            <h4 class="lg-1-item-title">Amazing Place</h4>
                            <p>{{ __('Lura, capio, et diatria. Mori recte ducunt ad alter plasmator. Experimentum sapienter ducunt ad audax.') }}</p>
                        </div>
                    </article>
                </li>
                <li class="col-sm-6 col-lg-3">
                    <article class="lg-1-item">
                        <div class="icon lg-1-item-icon linearicons-archery"></div>
                        <div class="lg-1-item-main">
                            <h4 class="lg-1-item-title">Result-Based</h4>
                            <p>{{ __('Indexs ortum! Classiss sunt solitudos de altus adgium. Castus, regius triticums superbe anhelare.') }}</p>
                        </div>
                    </article>
                </li>
                <li class="col-sm-6 col-lg-3">
                    <article class="lg-1-item">
                        <div class="icon lg-1-item-icon linearicons-teacup"></div>
                        <div class="lg-1-item-main">
                            <h4 class="lg-1-item-title">Tailored Solutions</h4>
                            <p>{{ __('Cur nixus mori? Pol. Sunt hippotoxotaes convertam festus, brevis buboes. Brevis terror nunquam amors.') }}</p>
                        </div>
                    </article>
                </li>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="range">
            <div class="cell-lg-7 cell-xl-8 cell-xxl-9">
                <div class="cell-inner section-lg text-center text-sm-left">
                    <h3>{{ __('Meet Our Team') }}</h3>
                    <p>{{ __('Duis aute irure dolor in reprehenderit in voluptate velit') }}</p>
                    <div class="owl-carousel owl-1 mt-lg-50" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="2" data-xl-items="3" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="30" data-mouse-drag="false">
                        <article class="profile-classic">
                            <img class="profile-classic-image" src="{{ asset('images/our-team-1-272x197.jpg') }}" alt="" width="272" height="197"/>
                            <div class="profile-classic-main">
                                <p class="heading-5 profile-classic-position">{{ __('Adult Instructor') }}</p>
                                <p class="profile-classic-name heading-4">Sam Reed</p>
                                <div class="profile-classic-unit">
                                    <div class="icon mdi mdi-phone"></div>
                                    <a class="heading-6" href="tel:#">1-800-36-677</a>
                                </div>
                            </div>
                        </article>
                        <article class="profile-classic">
                            <img class="profile-classic-image" src="{{ asset('images/our-team-2-272x197.jpg') }}" alt="" width="272" height="197"/>
                            <div class="profile-classic-main">
                                <p class="heading-5 profile-classic-position">{{ __('Teen Instructor') }}</p>
                                <p class="profile-classic-name heading-4">Emma Jones</p>
                                <div class="profile-classic-unit">
                                    <div class="icon mdi mdi-phone"></div>
                                    <a class="heading-6" href="tel:#">1-800-36-677</a>
                                </div>
                            </div>
                        </article>
                        <article class="profile-classic">
                            <img class="profile-classic-image" src="{{ asset('images/our-team-3-272x197.jpg') }}" alt="" width="272" height="197"/>
                            <div class="profile-classic-main">
                                <p class="heading-5 profile-classic-position">{{ __('Kids Instructor') }}</p>
                                <p class="profile-classic-name heading-4">Peter Smith</p>
                                <div class="profile-classic-unit">
                                    <div class="icon mdi mdi-phone"></div>
                                    <a class="heading-6" href="tel:#">1-800-36-677</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="cell-lg-5 cell-xl-4 cell-xxl-3 height-fill">
                <div class="box-3 bg-image" style="background-image: url({{ asset('images/about-2.jpg') }});"></div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-default bg-color-gray-100">
        <div class="container">
            <div class="owl-carousel owl-2" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-xl-items="5" data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false" data-margin="30" data-mouse-drag="false">
                <a class="link-image" href="#"><img src="{{ asset('images/brand-1-228x162.png') }}" alt="" width="228" height="162"/></a>
                <a class="link-image" href="#"><img src="{{ asset('images/brand-2-228x162.png') }}" alt="" width="228" height="162"/></a>
                <a class="link-image" href="#"><img src="{{ asset('images/brand-3-228x162.png') }}" alt="" width="228" height="162"/></a>
                <a class="link-image" href="#"><img src="{{ asset('images/brand-4-228x162.png') }}" alt="" width="228" height="162"/></a>
                <a class="link-image" href="#"><img src="{{ asset('images/brand-5-228x162.png') }}" alt="" width="228" height="162"/></a>
            </div>
        </div>
    </section>
@endsection
