{{-- resources/views/page.blade.php --}}
@extends('layouts.app')

@section('title', $page->title)

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <h3 class="wow fadeIn mb-4">{{ $page->title }}</h3>
            <div class="page-content">
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection
