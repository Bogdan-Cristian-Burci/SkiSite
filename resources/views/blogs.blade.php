{{-- resources/views/blogs.blade.php --}}
@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')

@section('title', __('News'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-30 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-4">
                    @include('partials.contact-form', ['layout' => 'compact', 'showSubject'=>false])
                </div>
                <div class="col-lg-8">
                    {{-- Loop through news posts --}}
                    @foreach($news as $post)
                        <article class="tour-modern mt-30 mt-xl-60 wow fadeIn" data-wow-delay=".05s">
                            <div class="tour-modern-media">
                                <a class="tour-modern-figure" href="{{ localized_route('blog.show', $post->getTranslation('slug', app()->getLocale())) }}">
                                    <img class="tour-modern-image" src="{{ Storage::disk('public')->url($post->image_path) }}" alt="" width="358" height="450"/>
                                </a>
                            </div>
                            <div class="tour-modern-main">
                                <h4 class="tour-modern-title">
                                    <a href="{{ localized_route('blog.show', $post->getTranslation('slug', app()->getLocale())) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="tour-modern-info">
                                    <p class="tour-modern-tag">{{ $post->categories->name }}</p>
                                </div>
                                <p>{{ $post->subtitle }}</p>
                            </div>
                        </article>
                    @endforeach

                    {{-- Pagination --}}
                    <nav class="pagination-outer text-center">
                        {{ $news->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
