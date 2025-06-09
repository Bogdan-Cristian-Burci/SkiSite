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
                        <p class="heading-4 box-1-title">{{$company->name}}</p>
                        <p class="box-1-address heading-5">{{ $company->address }}</p>
                        <p class="box-1-tel heading-3"><a href="{{$company->phone}}">{{$company->phone}}</a></p>
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
