{{-- resources/views/gallery.blade.php --}}
@extends('layouts.app')

@section('title', __('Gallery'))
@section('subtitle', __('Explore Our Gallery'))
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-6 row-x-6" data-lightgallery="group">
                {{-- Example static images, replace with dynamic content as needed --}}
                @foreach($galleries as $gallery)
                    <div class="col-md-4 col-sm-6 col-12">
                        <a class="thumbnail-light" href="{{ asset('storage/'.$gallery->image_path) }}" data-lightgallery="item">
                            <span class="caption">{{ $gallery->title }}</span>
                            <img class="thumbnail-light-image" src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}" width="383" height="290"/>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
