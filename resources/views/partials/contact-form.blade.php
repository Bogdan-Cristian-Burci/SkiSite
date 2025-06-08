{{-- Contact Form Partial - supports multiple layouts --}}
@php
    $formId = $formId ?? 'contact-form-' . uniqid();
    $layout = $layout ?? 'default'; // 'default', 'compact', 'inline'
    $showToggle = $showToggle ?? false;
    $title = $title ?? __('Get in Touch');
    $subtitle = $subtitle ?? __('Get in Touch with Us');
@endphp

@if($layout === 'compact' && $showToggle)
    {{-- Compact layout with toggle (original style) --}}
    <div class="block-custom-centered">
        <div class="box-4-outer">
            <button class="box-4-toggle" data-multitoggle="#{{ $formId }}" data-scope=".box-4-outer" aria-label="Filter Toggle">
                <span>{{ $title }}</span>
            </button>
            <article class="box-4" id="{{ $formId }}">
                <div class="box-4-inner">
                    <h4>{{ $subtitle }}</h4>
                    @include('partials.contact-form-fields', ['formId' => $formId, 'layout' => 'compact'])
                </div>
            </article>
        </div>
    </div>
@elseif($layout === 'inline')
    {{-- Inline layout for index page section --}}
    <article class="box-7 {{ $containerClass ?? 'mt-md-45 mt-xxl-70' }} wow fadeIn bg-gray-100">
        <div class="heading-4 text-center">{{ $title }}</div>
        @include('partials.contact-form-fields', ['formId' => $formId, 'layout' => 'inline'])
    </article>
@else
    {{-- Default full layout --}}
    <div class="{{ $wrapperClass ?? '' }}">
        @if($title)
            <h3>{{ $title }}</h3>
        @endif
        @include('partials.contact-form-fields', ['formId' => $formId, 'layout' => 'default'])
    </div>
@endif
