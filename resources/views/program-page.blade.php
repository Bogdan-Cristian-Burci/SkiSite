{{-- resources/views/program-page.blade.php --}}
@extends('layouts.app')

@section('title', $skiProgram->title ?? __('Program'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-40 row-xl-50 flex-lg-row-reverse">
                <div class="col-lg-4">
                    @include('partials.contact-form')
                </div>
                <div class="col-lg-8">
                    <article class="post-info">
                        <h3 class="post-info-title">{{ $skiProgram->title }}</h3>
                        <div class="post-info-details mb-1">
                            <p class="post-info-price">{{ $skiProgram->price }}</p>
                            <p class="big">{{ $skiProgram->price_label }}</p>
                        </div>
                        <div>{!! $skiProgram->description !!}</div>
                        @if(!empty($skiProgram->details))
                                <div>{!! $skiProgram->details !!}</div>
                        @endif
                        <table class="post-info-table">
                            <tr>
                                <td>{{ __('What’s Included') }}</td>
                                <td>
                                    <div class="row row-10 block-3">

                                            <div class="col-md-12">
                                                <ul class="list-marked list-two-cols" style="display:flex; flex-wrap: wrap;">
                                                    @foreach($skiProgram->included_services as $item)
                                                        <li style="width:50%;margin-top:0;">{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h3 class="mt-30 mt-lg-50 mt-xl-80">{{ __('How We Work') }}</h3>
                        <p>{!! $skiProgram->how_we_work !!}</p>
                        <div class="row row-6 row-x-6" data-lightgallery="group">
                            @foreach($skiProgram->gallery as $image)
                                <div class="col-4">
                                    <a class="thumbnail-light" href="{{ asset($image) }}" data-lightgallery="item">
                                        <img class="thumbnail-light-image" src="{{ asset($image) }}" alt="" width="355" height="359"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
