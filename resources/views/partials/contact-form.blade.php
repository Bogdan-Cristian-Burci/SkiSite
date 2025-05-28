{{-- resources/views/partials/contact-form.blade.php --}}
<div class="block-custom-centered">
    <div class="box-4-outer">
        <button class="box-4-toggle" data-multitoggle="#box-4" data-scope=".box-4-outer" aria-label="Filter Toggle">
            <span>{{ __('Get in Touch') }}</span>
        </button>
        <article class="box-4" id="box-4">
            <div class="box-4-inner">
                <h4>{{ __('Get in Touch with Us') }}</h4>
                <form class="rd-form rd-mailform form-lg" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-wrap form-wrap-icon">
                        <input class="form-input" id="contact-name-2" type="text" name="name" required>
                        <label class="form-label" for="contact-name-2">{{ __('Name') }}</label>
                        <div class="icon form-icon mdi mdi-account-outline"></div>
                    </div>
                    <div class="form-wrap form-wrap-icon">
                        <input class="form-input" id="contact-email-2" type="email" name="email" required>
                        <label class="form-label" for="contact-email-2">{{ __('E-mail') }}</label>
                        <div class="icon form-icon mdi mdi-email-outline"></div>
                    </div>
                    <div class="form-wrap form-wrap-icon">
                        <label class="form-label" for="contact-message-2">{{ __('Message') }}</label>
                        <textarea class="form-input" id="contact-message-2" name="message" required></textarea>
                        <div class="icon form-icon mdi mdi-message-outline"></div>
                    </div>
                    <div class="form-wrap mt-40 mt-xl-55">
                        <button class="button button-lg button-primary button-block" type="submit">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </article>
    </div>
</div>
