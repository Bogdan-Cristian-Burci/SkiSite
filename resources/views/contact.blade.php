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
            <h3>{{ __('Get in Touch') }}</h3>
            <form class="rd-form rd-mailform form-lg" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="row row-30">
                    <div class="col-lg-4">
                        <div class="form-wrap form-wrap-icon">
                            <input class="form-input" id="contact-name" type="text" name="name" required>
                            <label class="form-label" for="contact-name">{{ __('Name') }}</label>
                            <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-wrap form-wrap-icon">
                            <input class="form-input" id="contact-phone" type="text" name="phone" required>
                            <label class="form-label" for="contact-phone">{{ __('Phone') }}</label>
                            <div class="icon form-icon mdi mdi-phone text-primary"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-wrap form-wrap-icon">
                            <input class="form-input" id="contact-email" type="email" name="email" required>
                            <label class="form-label" for="contact-email">{{ __('E-mail') }}</label>
                            <div class="icon form-icon mdi mdi-email-outline text-primary"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-wrap form-wrap-icon">
                            <label class="form-label" for="contact-message">{{ __('Message') }}</label>
                            <textarea class="form-input" id="contact-message" name="message" required></textarea>
                            <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                        </div>
                    </div>
                </div>
                <div class="form-wrap form-wrap-button">
                    <button class="button button-lg button-primary" type="submit">{{ __('Send') }}</button>
                </div>
            </form>
        </div>
    </section>
@endsection
