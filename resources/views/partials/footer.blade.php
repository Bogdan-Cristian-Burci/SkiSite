<!-- Page Footer-->
<footer class="section footer-classic footer-classic-md">
    <div class="footer-classic-main">
        <div class="container">
            <div class="footer-classic-layout justify-content-sm-around justify-content-md-between">
                <div class="footer-classic-layout-item">
                    <!-- Brand -->
                    <a class="brand" href="{{ localized_route('home') }}">
                        <img class="brand-logo-dark" src="{{ asset('images/logo-default-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                        <img class="brand-logo-light" src="{{ asset('images/logo-inverse-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                        <img class="brand-logo-white" src="{{ asset('images/logo-white-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                    </a>
                    <div class="footer-classic-item-block footer-classic-item-block-1">
                        <p class="text-white-07 block-1">
                            {{ config('site.description', 'SkiUp ski school provides a variety of courses and activities for learners of any age and skill level. With us, you\'ll be skiing confidently in no time.') }}
                        </p>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h4 class="footer-classic-title inset-3">What We Offer</h4>
                    <div class="footer-classic-item-block footer-classic-item-block-3">
                        <ul class="list-marked__creative">
                            <li><a href="{{ localized_route('programs') }}">Kids' Skiing Classes</a></li>
                            <li><a href="{{ localized_route('programs') }}">Beginner Classes</a></li>
                            <li><a href="{{ localized_route('programs') }}">Intermediate Classes</a></li>
                            <li><a href="{{ localized_route('programs') }}">Advanced Classes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h4 class="footer-classic-title inset-3">Contact Us</h4>
                    <div class="footer-classic-item-block">
                        <ul class="list list-1">
                            <li><a href="{{ localized_route('contact') }}">Send a Message</a></li>
                            <li><a href="{{ localized_route('contact') }}">Contacts</a></li>
                            <li><a href="{{ localized_route('contact') }}">Book a Lesson</a></li>
                        </ul>
                        <ul class="list-inline list-inline-md">
                            <li>
                                <a class="link-2 icon mdi mdi-instagram" href="{{ config('social.instagram', '#') }}"></a>
                            </li>
                            <li>
                                <a class="link-2 icon mdi mdi-facebook" href="{{ config('social.facebook', '#') }}"></a>
                            </li>
                            <li>
                                <a class="link-2 icon mdi mdi-youtube-play" href="{{ config('social.youtube', '#') }}"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-0">
        <div class="divider-2"></div>
    </div>
    <div class="footer-classic-aside">
        <div class="container">
            <p class="rights">
                <span>&copy;&nbsp;</span>
                <span class="copyright-year">{{ date('Y') }}</span>
                <span>&nbsp;</span>
                <span>{{ config('app.name', 'SkiUp') }}</span>
                <span>. All rights reserved.&nbsp;</span>
                <a href="{{ localized_route('privacy-policy') }}">Privacy Policy</a>
            </p>
        </div>
    </div>
</footer>
