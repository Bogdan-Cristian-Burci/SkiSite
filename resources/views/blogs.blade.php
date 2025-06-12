{{-- resources/views/blogs.blade.php --}}
@extends('layouts.app')

@section('title', __('News'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="breadcrumbs-custom">
        <div class="container">
            <div class="breadcrumbs-custom-main">
                <h2 class="breadcrumbs-custom-title">{{ __('News') }}</h2>
                <p>{{ __('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis aute irure dolor in reprehenderit.') }}</p>
            </div>
        </div>
    </section>

    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-30 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-4">
                    @include('partials.contact-form')
                </div>
                <div class="col-lg-8">
                    {{-- Loop through news posts --}}
                    @foreach($news as $post)
                        <article class="tour-modern mt-30 mt-xl-60 wow fadeIn" data-wow-delay=".05s">
                            <div class="tour-modern-media">
                                <a class="tour-modern-figure" href="{{ localized_route('blog.show', $post->getTranslation('slug', app()->getLocale())) }}">
                                    <img class="tour-modern-image" src="{{ asset($post->image) }}" alt="" width="358" height="450"/>
                                </a>
                            </div>
                            <div class="tour-modern-main">
                                <h4 class="tour-modern-title">
                                    <a href="{{ localized_route('blog.show', $post->getTranslation('slug', app()->getLocale())) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="tour-modern-info">
                                    <p class="tour-modern-tag">{{ $post->category }}</p>
                                </div>
                                <p>{{ $post->excerpt }}</p>
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
