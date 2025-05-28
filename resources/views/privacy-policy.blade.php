{{-- resources/views/privacy-policy.blade.php --}}
@extends('layouts.app')

@section('title', __('Privacy Policy'))

@section('header')
    @include('partials.header-inner')
@endsection

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <h3 class="wow fadeIn mb-4">{{ __('Privacy Policy') }}</h3>
            <dl class="list-terms">
                <dt class="heading-5">{{ __('General information') }}</dt>
                <dd>{{ __('Welcome to our Privacy Policy page! When you use our website services, you trust us with your information. This Privacy Policy is meant to help you understand what data we collect, why we collect it, and what we do with it. When you share information with us, we can make our services even better for you. As you use our services, we want you to be clear how we’re using information and the ways in which you can protect your privacy. This is important; we hope you will take time to read it carefully.') }}</dd>

                <dt class="heading-5">{{ __('Right to access, correct and delete data and to object to data processing') }}</dt>
                <dd>{{ __('Our customers have the right to access, correct and delete personal data relating to them, and to object to the processing of such data, by addressing a written request, at any time. The Company makes every effort to put in place suitable precautions to safeguard the security and privacy of personal data, and to prevent it from being altered, corrupted, destroyed or accessed by unauthorized third parties. However, the Company does not control each and every risk related to the use of the Internet, and therefore warns the Site users of the potential risks involved in the functioning and use of the Internet. The Site may include links to other web sites or other internet sources. As the Company cannot control these web sites and external sources, the Company cannot be held responsible for the provision or display of these web sites and external sources, and may not be held liable for the content, advertising, products, services or any other material available on or from these web sites or external sources.') }}</dd>

                <dt class="heading-5">{{ __('Management of personal data') }}</dt>
                <dd>{{ __('You can view or edit your personal data online for many of our services. You can also make choices about our collection and use of your data. How you can access or control your personal data will depend on which services you use. You can choose whether you wish to receive promotional communications from our website by email, SMS, physical mail, and telephone. If you receive promotional email or SMS messages from us and would like to opt out, you can do so by following the directions in that message. These choices do not apply to mandatory service communications that are part of certain website services.') }}</dd>

                <dt class="heading-5">{{ __('Information We Collect') }}</dt>
                <dd>{{ __('Our store collects data to operate effectively and provide you the best experiences with our services. You provide some of this data directly, such as when you create a personal account. We get some of it by recording how you interact with our services by, for example, using technologies like cookies, and receiving error reports or usage data from software running on your device. We also obtain data from third parties (including other companies). The data we collect depends on the services and features you use.') }}</dd>

                <dt class="heading-5">{{ __('How We Use Your Information') }}</dt>
                <dd>{{ __('Our website uses the data we collect for three basic purposes: to operate our business and provide (including improving and personalizing) the services we offer, to send communications, including promotional communications, and to display advertising. In carrying out these purposes, we combine data we collect through the various website services you use to give you a more seamless, consistent and personalized experience.') }}</dd>

                <dt class="heading-5">{{ __('Sharing Your Information') }}</dt>
                <dd>{{ __('We share your personal data with your consent or as necessary to complete any transaction or provide any service you have requested or authorized. For example, we share your content with third parties when you tell us to do so. When you provide payment data to make a purchase, we will share payment data with banks and other entities that process payment transactions or provide other financial services, and for fraud prevention and credit risk reduction. In addition, we share personal data among our controlled affiliates and subsidiaries. We also share personal data with vendors or agents working on our behalf for the purposes described in this statement.') }}</dd>
            </dl>
            <a class="privacy-link" href="mailto:privacy@demolink.org">privacy@demolink.org</a>
        </div>
    </section>
@endsection
