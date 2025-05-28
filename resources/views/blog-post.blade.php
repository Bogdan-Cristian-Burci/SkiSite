{{-- resources/views/blog-post.blade.php --}}
@extends('layouts.app')

@section('title', $post->title ?? __('Blog Post'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="breadcrumbs-custom">
        <div class="container">
            <div class="breadcrumbs-custom-main">
                <h2 class="breadcrumbs-custom-title">{{ $post->title }}</h2>
                <p>{{ $post->subtitle ?? __('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis aute irure dolor in reprehenderit.') }}</p>
            </div>
        </div>
    </section>

    <section class="section section-md bg-default">
        <div class="container">
            <article class="blog-layout">
                <div class="blog-layout-main">
                    <div class="blog-layout-main-item">
                        <article class="post-corporate">
                            <img class="post-corporate-image" src="{{ asset($post->main_image) }}" alt="" width="768" height="396"/>
                            <ul class="post-corporate-meta">
                                <li>
                                    <span class="icon mdi mdi-calendar-today"></span>
                                    <time datetime="{{ $post->date->format('Y-m-d') }}">{{ $post->date->format('F d, Y') }}</time>
                                </li>
                                <li>
                                    <span class="icon mdi mdi-account"></span>
                                    <span>{{ $post->author }}</span>
                                </li>
                                <li>
                                    <span class="icon mdi mdi-tag-outline"></span>
                                    <span>{{ $post->category }}</span>
                                </li>
                            </ul>
                            <div class="post-corporate-divider"></div>
                            <h3 class="post-corporate-title">{{ $post->section_title }}</h3>
                            <p>{{ $post->content }}</p>
                            {{-- Add more sections/paragraphs as needed --}}
                            @if($post->quote)
                                <blockquote class="quote-primary">
                                    <div class="quote-primary-text">
                                        <p>{{ $post->quote }}</p>
                                    </div>
                                    <div class="quote-primary-footer">
                                        {{-- SVG and cite --}}
                                        <p class="heading-5 quote-primary-cite">{{ $post->quote_author }}</p>
                                    </div>
                                </blockquote>
                            @endif
                            {{-- Gallery --}}
                            @if($post->gallery)
                                <div class="post-corporate-gallery" data-lightgallery="group">
                                    @foreach($post->gallery as $image)
                                        <a class="post-corporate-thumbnail" href="{{ asset($image['original']) }}" data-lightgallery="item">
                                            <img class="post-corporate-thumbnail-image" src="{{ asset($image['thumb']) }}" alt=""/>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <ul class="post-corporate-tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="#">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                            <div class="post-corporate-divider"></div>
                            <div class="post-corporate-footer">
                                <h5 class="font-weight-sbold">Share this post</h5>
                                <div>
                                    <div class="group group-sm">
                                        <a class="link-1 icon mdi mdi-facebook" href="#"></a>
                                        <a class="link-1 icon mdi mdi-instagram" href="#"></a>
                                        <a class="link-1 icon mdi mdi-behance" href="#"></a>
                                        <a class="link-1 icon mdi mdi-twitter" href="#"></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    {{-- Related Posts --}}
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Related Posts') }}</h3>
                        <div class="row row-40">
                            @foreach($relatedPosts as $related)
                                <div class="col-sm-6">
                                    <article class="post-classic ml-0">
                                        <a class="post-classic-figure" href="{{ route('blog.show', ['id' => $related->id]) }}">
                                            <img class="post-classic-image" src="{{ asset($related->image) }}" alt="" width="339" height="251"/>
                                        </a>
                                        <time class="post-classic-time" datetime="{{ $related->date->format('Y-m-d') }}">{{ $related->date->format('F d, Y') }}</time>
                                        <div class="post-classic-divider"></div>
                                        <p class="heading-4 post-classic-title">
                                            <a href="{{ route('blog.show', ['id' => $related->id]) }}">{{ $related->title }}</a>
                                        </p>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Comments Form --}}
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Leave a Reply') }}</h3>
                        <form class="rd-form rd-mailform form-lg" method="post" action="{{ route('comments.store', ['post' => $post->id]) }}">
                            @csrf
                            <div class="row row-30">
                                <div class="col-md-6">
                                    <div class="form-wrap form-wrap-icon">
                                        <input class="form-input" id="contact-name" type="text" name="name" required>
                                        <label class="form-label" for="contact-name">{{ __('Name') }}</label>
                                        <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                </div>
                {{-- Sidebar --}}
                <div class="blog-layout-aside">
                    {{-- Search --}}
                    <div class="blog-layout-aside-item">
                        <form class="rd-search rd-search-inline block-2 block-centered" action="{{ route('search') }}" method="GET">
                            <div class="form-wrap">
                                <label class="form-label" for="rd-search-form-input">{{ __('Search...') }}</label>
                                <input class="form-input" id="rd-search-form-input" type="text" name="s" autocomplete="off">
                            </div>
                            <div class="form-button">
                                <button class="rd-search-submit" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    {{-- Categories --}}
                    <div class="blog-layout-aside-item">
                        <h4>{{ __('Categories') }}</h4>
                        <ul class="list-categories">
                            @foreach($categories as $category)
                                <li>
                                    <a href="#">
                                        <span class="lc-text">{{ $category->name }}</span>
                                        <span class="lc-counter">{{ $category->count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- New Posts --}}
                    <div class="blog-layout-aside-item">
                        <h4>{{ __('New Posts') }}</h4>
                        <div class="group-post-minimal">
                            @foreach($newPosts as $new)
                                <article class="post-minimal">
                                    <a class="post-minimal-media" href="{{ route('blog.show', ['id' => $new->id]) }}">
                                        <img class="post-minimal-image" src="{{ asset($new->image) }}" alt="" width="79" height="78"/>
                                    </a>
                                    <div class="post-minimal-main">
                                        <h6 class="post-minimal-title">
                                            <a href="{{ route('blog.show', ['id' => $new->id]) }}">{{ $new->title }}</a>
                                        </h6>
                                        <time class="post-minimal-time" datetime="{{ $new->date->format('Y-m-d') }}">{{ $new->date->format('F d, Y') }}</time>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    {{-- Subscribe --}}
                    <div class="blog-layout-aside-item">
                        <h4>{{ __('Subscribe') }}</h4>
                        <form class="rd-form rd-mailform" method="post" action="{{ route('subscribe') }}">
                            @csrf
                            <div class="form-wrap form-wrap-icon">
                                <input class="form-input" id="subscribe-form-email" type="email" name="email" required>
                                <label class="form-label" for="subscribe-form-email">{{ __('E-mail') }}</label>
                                <div class="icon form-icon mdi mdi-email-outline"></div>
                            </div>
                            <div class="form-wrap mt-30">
                                <button class="button button-block button-lg button-primary" type="submit">{{ __('Send') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection
