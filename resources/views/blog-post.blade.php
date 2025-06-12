{{-- resources/views/blog-post.blade.php --}}
@php
use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')

@section('title', $blogPost->title ?? __('Blog Post'))
@section('subtitle', $blogPost->subtitle ?? __('Read Our Latest Blog Post'))

{{-- Include the header section --}}
@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-default">
        <div class="container">
            <article class="blog-layout">
                <div class="blog-layout-main">
                    <div class="blog-layout-main-item">
                        <article class="post-corporate">
                            <img class="post-corporate-image" src="{{ Storage::disk('public')->url($blogPost->image_path) }}" alt="" width="768" height="396"/>
                            <ul class="post-corporate-meta">
                                <li>
                                    <span class="icon mdi mdi-calendar-today"></span>
                                    <time datetime="{{ $blogPost->created_at->format('Y-m-d') }}">{{ $blogPost->created_at->format('F d, Y') }}</time>
                                </li>
                                <li>
                                    <span class="icon mdi mdi-account"></span>
                                    <span>{{ $blogPost->user->name }}</span>
                                </li>
                            </ul>
                            <div class="post-corporate-divider mb-2"></div>

                            <div class="w-full">{!! $blogPost->content !!}</div>

                            {{-- Gallery --}}
                            @if($blogPost->galery && count($blogPost->galery) > 0)
                                <div class="mt-4 mb-4">
                                    <h4 class="mb-3">{{ __('Gallery') }}</h4>
                                    <div class="row row-20" data-lightgallery="group">
                                        @foreach($blogPost->galery as $imagePath)
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <a class="gallery-item" href="{{ Storage::disk('public')->url($imagePath) }}" data-lightgallery="item">
                                                    <img class="img-fluid rounded" src="{{ Storage::disk('public')->url($imagePath) }}" alt="Gallery Image" style="height: 200px; object-fit: cover; width: 100%;"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="post-corporate-divider"></div>
                            <div class="post-corporate-footer">
                                <h5 class="font-weight-sbold">{{__("Share this post")}}</h5>
                                <div>
                                    <div class="group group-sm">
                                        <a class="link-1 icon mdi mdi-facebook"
                                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                           target="_blank" rel="noopener" title="Share on Facebook"></a>
                                        <a class="link-1 icon mdi mdi-twitter"
                                           href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blogPost->title) }}"
                                           target="_blank" rel="noopener" title="Share on Twitter"></a>
                                        <a class="link-1 icon mdi mdi-linkedin"
                                           href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($blogPost->title) }}"
                                           target="_blank" rel="noopener" title="Share on LinkedIn"></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    {{-- Related Posts --}}
                    @if($relatedPosts->count() > 0)
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Related Posts') }}</h3>
                        <div class="row row-40">
                            @foreach($relatedPosts as $related)
                                <div class="col-sm-6">
                                    <article class="post-classic ml-0">
                                        <a class="post-classic-figure" href="{{ localized_route('blog.show', $related->getTranslation('slug', app()->getLocale())) }}">
                                            <img class="post-classic-image" src="{{ Storage::disk('public')->url($related->image_path) }}" alt="" width="339" height="251"/>
                                        </a>
                                        <time class="post-classic-time" datetime="{{ $related->created_at->format('Y-m-d') }}">{{ $related->created_at->format('F d, Y') }}</time>
                                        <div class="post-classic-divider"></div>
                                        <p class="heading-4 post-classic-title">
                                            <a href="{{ localized_route('blog.show', $related->getTranslation('slug', app()->getLocale())) }}">{{ $related->title }}</a>
                                        </p>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    {{-- Comments Section --}}
                    @if($comments->count() > 0)
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Comments') }} ({{ $comments->count() }})</h3>
                        <div class="comments-list">
                            @foreach($comments as $comment)
                                <div class="comment-item" style="border-bottom: 1px solid #eee; padding: 20px 0; margin-bottom: 20px;">
                                    <div class="comment-meta" style="display: flex; align-items: center; margin-bottom: 10px;">
                                        <div class="comment-author" style="font-weight: bold; margin-right: 15px;">
                                            {{ $comment->user->name }}
                                        </div>
                                        <div class="comment-date" style="color: #666; font-size: 0.9em;">
                                            {{ $comment->created_at->format('F d, Y \\a\\t H:i') }}
                                        </div>
                                    </div>
                                    <div class="comment-content" style="line-height: 1.6;">
                                        {!! nl2br(e($comment->content)) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Comments Form --}}
                    @auth
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Leave a Reply') }}</h3>

                        @if(session('success'))
                            <div class="alert alert-success" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger" style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="rd-form rd-mailform form-lg" method="post" action="{{ route('comments.store', ['blogPost' => $blogPost->id]) }}">
                            @csrf
                            <div class="row row-30">
                                <div class="col-12">
                                    <div class="form-wrap form-wrap-icon">
                                        <textarea class="form-input" id="comment-content" name="content" rows="5" required placeholder="{{ __('Write your comment here...') }}">{{ old('content') }}</textarea>
                                        <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrap form-wrap-button">
                                <button class="button button-lg button-primary" type="submit">{{ __('Post Comment') }}</button>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="blog-layout-main-item">
                        <h3>{{ __('Leave a Reply') }}</h3>
                        <p>{{ __('You must be') }} <a href="{{ route('login') }}">{{ __('logged in') }}</a> {{ __('to post a comment.') }}</p>
                    </div>
                    @endauth
                </div>
                {{-- Sidebar --}}
                <div class="blog-layout-aside">
                    {{-- Search --}}
{{--                    <div class="blog-layout-aside-item">--}}
{{--                        <form class="rd-search rd-search-inline block-2 block-centered" action="{{ route('search') }}" method="GET">--}}
{{--                            <div class="form-wrap">--}}
{{--                                <label class="form-label" for="rd-search-form-input">{{ __('Search...') }}</label>--}}
{{--                                <input class="form-input" id="rd-search-form-input" type="text" name="s" autocomplete="off">--}}
{{--                            </div>--}}
{{--                            <div class="form-button">--}}
{{--                                <button class="rd-search-submit" type="submit"></button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}

                    {{-- New Posts --}}
                    <div class="blog-layout-aside-item">
                        <h4>{{ __('New Posts') }}</h4>
                        <div class="group-post-minimal">
                            @foreach($newPosts as $new)
                                <article class="post-minimal">
                                    <a class="post-minimal-media" href="{{ localized_route('blog.show', $new->getTranslation('slug', app()->getLocale())) }}">
                                        <img class="post-minimal-image" src="{{ Storage::disk('public')->url($new->image_path) }}" alt="" width="79" height="78"/>
                                    </a>
                                    <div class="post-minimal-main">
                                        <h6 class="post-minimal-title">
                                            <a href="{{ localized_route('blog.show', $new->getTranslation('slug', app()->getLocale())) }}">{{ $new->title }}</a>
                                        </h6>
                                        <time class="post-minimal-time" datetime="{{ $new->created_at->format('Y-m-d') }}">{{ $new->created_at->format('F d, Y') }}</time>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    {{-- Subscribe --}}
{{--                    <div class="blog-layout-aside-item">--}}
{{--                        <h4>{{ __('Subscribe') }}</h4>--}}
{{--                        <form class="rd-form rd-mailform" method="post" action="{{ route('subscribe') }}">--}}
{{--                            @csrf--}}
{{--                            <div class="form-wrap form-wrap-icon">--}}
{{--                                <input class="form-input" id="subscribe-form-email" type="email" name="email" required>--}}
{{--                                <label class="form-label" for="subscribe-form-email">{{ __('E-mail') }}</label>--}}
{{--                                <div class="icon form-icon mdi mdi-email-outline"></div>--}}
{{--                            </div>--}}
{{--                            <div class="form-wrap mt-30">--}}
{{--                                <button class="button button-block button-lg button-primary" type="submit">{{ __('Send') }}</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
            </article>
        </div>
    </section>
@endsection
