{{-- resources/views/webcam.blade.php --}}
@extends('layouts.app')

@section('title', __('Webcams'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <h3 class="wow fadeIn mb-4">{{ __('Live Webcams') }}</h3>
            <div class="row row-30">
                @foreach($webcams as $webcam)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $webcam->title }}</h5>
                                    <div class="webcam-iframe-wrapper">
                                        <iframe
                                        src={{$webcam->iframe_link}}
                                        width="100%" height="320" frameborder="0" allowfullscreen
                                        style="border-radius: 8px; background: #000;">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach
            </div>
        </div>
    </section>
@endsection
