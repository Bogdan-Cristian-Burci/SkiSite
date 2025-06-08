{{-- Contact Form Fields --}}
@php
    $formId = $formId ?? 'contact-form';
    $layout = $layout ?? 'default';
    $showSubject = $showSubject ?? true;
    $showCategory = $showCategory ?? false;
    $messageRows = $messageRows ?? ($layout === 'compact' ? '3' : '4');
@endphp

<!-- Success Message -->
<div id="{{ $formId }}-success" class="alert alert-success" style="display: none;">
    <i class="mdi mdi-check-circle"></i>
    <span id="{{ $formId }}-success-message"></span>
</div>

<!-- Error Messages -->
<div id="{{ $formId }}-errors" class="alert alert-danger" style="display: none;">
    <i class="mdi mdi-alert-circle"></i>
    <ul id="{{ $formId }}-error-list"></ul>
</div>

<form id="{{ $formId }}" class="rd-form rd-mailform form-lg" method="POST" action="{{ route('contact.store') }}">
    @csrf

    @if($layout === 'compact')
        {{-- Compact layout - single column --}}
        <div class="form-wrap form-wrap-icon">
            <input class="form-input" id="{{ $formId }}-name" type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Please enter your name.') }}">
            <div class="icon form-icon mdi mdi-account-outline"></div>
        </div>
        <div class="form-wrap form-wrap-icon">
            <input class="form-input" id="{{ $formId }}-email" type="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('Please enter your email address.') }}">
            <div class="icon form-icon mdi mdi-email-outline"></div>
        </div>
        @if($showSubject)
        <div class="form-wrap form-wrap-icon">
            <input class="form-input" id="{{ $formId }}-subject" type="text" name="subject" value="{{ old('subject') }}" required  placeholder="{{__('Please enter a subject.')}}">
            <div class="icon form-icon mdi mdi-text-subject"></div>
        </div>
        @endif
        <div class="form-wrap form-wrap-icon">
            <textarea class="form-input" id="{{ $formId }}-message" name="message" rows="{{ $messageRows }}" required  placeholder="{{__('Please enter your message.')}}">{{ old('message') }}</textarea>
            <div class="icon form-icon mdi mdi-message-outline"></div>
        </div>
        <div class="form-wrap mt-40 mt-xl-55">
            <button id="{{ $formId }}-submit" class="button button-lg button-primary button-block" type="submit">
                <span class="btn-text">{{ __('Send') }}</span>
                <span class="btn-loading" style="display: none;">
                    <i class="mdi mdi-loading mdi-spin"></i> {{ __('Sending...') }}
                </span>
            </button>
        </div>

    @elseif($layout === 'inline')
        {{-- Inline layout - two columns --}}
        <div class="row row-30">
            <div class="col-md-6">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-name" type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Please enter your name.') }}">
                    <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-email" type="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('Please enter your email address.') }}">
                    <div class="icon form-icon mdi mdi-email-outline text-primary"></div>
                </div>
            </div>
            @if($showSubject)
            <div class="col-md-12">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-subject" type="text" name="subject" value="{{ old('subject') }}" required placeholder="{{__('Please enter a subject.')}}">
                    <div class="icon form-icon mdi mdi-text-subject text-primary"></div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="form-wrap form-wrap-icon">
                    <textarea class="form-input" id="{{ $formId }}-message" name="message" rows="{{ $messageRows }}" required placeholder="{{__('Please enter your message.')}}">{{ old('message') }}</textarea>
                    <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                </div>
            </div>
        </div>
        <div class="form-wrap form-wrap-button">
            <button id="{{ $formId }}-submit" class="button button-lg button-primary" type="submit">
                <span class="btn-text">{{ __('Send') }}</span>
                <span class="btn-loading" style="display: none;">
                    <i class="mdi mdi-loading mdi-spin"></i> {{ __('Sending...') }}
                </span>
            </button>
        </div>

    @else
        {{-- Default layout - responsive columns --}}
        <div class="row row-30">
            <div class="col-lg-6">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-name" type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Please enter your name.') }}">
                    <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-email" type="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('Please enter your email address.') }}">
                    <div class="icon form-icon mdi mdi-email-outline text-primary"></div>
                </div>
            </div>
            @if($showSubject)
            <div class="col-lg-12">
                <div class="form-wrap form-wrap-icon">
                    <input class="form-input" id="{{ $formId }}-subject" type="text" name="subject" value="{{ old('subject') }}" required placeholder="{{__('Please enter a subject.')}}">
                    <div class="icon form-icon mdi mdi-text-subject text-primary"></div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="form-wrap form-wrap-icon">
                    <textarea class="form-input" id="{{ $formId }}-message" name="message" rows="{{ $messageRows }}" required placeholder="__('Please enter your message.')">{{ old('message') }}</textarea>
                    <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                </div>
            </div>
        </div>
        <div class="form-wrap form-wrap-button">
            <button id="{{ $formId }}-submit" class="button button-lg button-primary" type="submit">
                <span class="btn-text">{{ __('Send') }}</span>
                <span class="btn-loading" style="display: none;">
                    <i class="mdi mdi-loading mdi-spin"></i> {{ __('Sending...') }}
                </span>
            </button>
        </div>
    @endif
</form>

<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
    .alert i {
        margin-right: 8px;
    }
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    .btn-loading .mdi-spin {
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('{{ $formId }}');
        const submitBtn = document.getElementById('{{ $formId }}-submit');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const successDiv = document.getElementById('{{ $formId }}-success');
        const errorsDiv = document.getElementById('{{ $formId }}-errors');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';

            // Hide previous messages
            successDiv.style.display = 'none';
            errorsDiv.style.display = 'none';

            // Submit form
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    document.getElementById('{{ $formId }}-success-message').textContent = data.message;
                    successDiv.style.display = 'block';

                    // Reset form
                    form.reset();

                    // Scroll to success message
                    successDiv.scrollIntoView({ behavior: 'smooth' });
                } else {
                    throw new Error(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                // Handle errors
                if (error.response) {
                    error.response.json().then(data => {
                        if (data.errors) {
                            // Validation errors
                            const errorList = document.getElementById('{{ $formId }}-error-list');
                            errorList.innerHTML = '';
                            Object.values(data.errors).flat().forEach(error => {
                                const li = document.createElement('li');
                                li.textContent = error;
                                errorList.appendChild(li);
                            });
                            errorsDiv.style.display = 'block';
                        } else {
                            // General error
                            document.getElementById('{{ $formId }}-error-list').innerHTML = '<li>' + (data.message || 'An error occurred') + '</li>';
                            errorsDiv.style.display = 'block';
                        }
                    });
                } else {
                    // Network or other error
                    document.getElementById('{{ $formId }}-error-list').innerHTML = '<li>' + error.message + '</li>';
                    errorsDiv.style.display = 'block';
                }

                // Scroll to error message
                errorsDiv.scrollIntoView({ behavior: 'smooth' });
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
            });
        });
    });
</script>
