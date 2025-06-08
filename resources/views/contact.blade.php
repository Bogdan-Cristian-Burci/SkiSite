{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', __('Contact Us'))
@section('subtitle', __('Get in Touch with Us'))
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-30">
                <div class="col-sm-6 col-lg-4">
                    <address class="box-1">
                        <p class="heading-4 box-1-title">California</p>
                        <p class="box-1-address heading-5">40 West Rd, Olympic Valley, CA 96146</p>
                        <p class="box-1-tel heading-3"><a href="tel:1-858-219-3500">1-858-219-3500</a></p>
                    </address>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <address class="box-1">
                        <p class="heading-4 box-1-title">Colorado</p>
                        <p class="box-1-address heading-5">15 Sussex Str, Breckenridge, CO 80424</p>
                        <p class="box-1-tel heading-3"><a href="tel:1-970-964-1989">1-970-964-1989</a></p>
                    </address>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <address class="box-1">
                        <p class="heading-4 box-1-title">Michigan</p>
                        <p class="box-1-address heading-5">453 Clarke Ave, White Lake, MI 57383</p>
                        <p class="box-1-tel heading-3"><a href="tel:1-248-615-0706">1-248-615-0706</a></p>
                    </address>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-default">
        <div class="container">
            @include('partials.contact-form', [
                'layout' => 'default',
                'title' => __('Get in Touch'),
                'showSubject' => true,
                'showCategory' => true,
                'messageRows' => '6'
            ])
        </div>
    </section>
@endsection
