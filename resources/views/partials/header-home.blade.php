<!-- Page Header-->
<header class="section page-header page-header-2 section-custom-1-ally">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="95px" data-xl-stick-up-offset="95px" data-xxl-stick-up-offset="95px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- Language Switcher (Mobile/Tablet) -->
                        <div class="navbar-lang-switcher navbar-lang-mobile" style="display: flex; gap: 10px; align-items: center; margin-right: 15px; z-index: 1000; order: -1;">
                            <a href="{{ route('lang.switch', 'ro') }}" style="display: inline-block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="{{ asset('images/flags/ro.gif') }}" alt="Română" width="26" height="17"
                                     style="{{ app()->getLocale() === 'ro' ? 'border:2px solid #007bff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 4px; opacity: 0.8; border: 1px solid #ddd;' }}">
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" style="display: inline-block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="{{ asset('images/flags/en.gif') }}" alt="English" width="26" height="17"
                                     style="{{ app()->getLocale() === 'en' ? 'border:2px solid #007bff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 4px; opacity: 0.8; border: 1px solid #ddd;' }}">
                            </a>
                        </div>
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap, .rd-navbar-toggle-element">
                            <span class="rd-navbar-toggle-inner">
                                <span class="rd-navbar-toggle-element"><span></span></span>
                                <span class="rd-navbar-toggle-text">{{__('Menu')}}</span>
                            </span>
                        </button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a class="brand" href="{{ route('home') }}">
                                <img class="brand-logo-dark" src="{{ asset('images/logo-default-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                                <img class="brand-logo-light" src="{{ asset('images/logo-inverse-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                                <img class="brand-logo-white" src="{{ asset('images/logo-white-306x104.png') }}" alt="{{ config('app.name') }}" width="153" height="52"/>
                            </a>
                        </div>
                    </div>
                    <div class="rd-navbar-aside-outer">
                        <button class="rd-navbar-aside-toggle" data-multitoggle="#rd-navbar-aside" aria-label="Aside Toggle">
                            <span></span>
                        </button>
                        <div class="rd-navbar-aside" id="rd-navbar-aside">
                            <ul class="rd-navbar-aside-list">
                                <li>
                                    <span class="icon mdi mdi-map-marker"></span>
                                    <a href="#">{{ config('site.address', '9 Valley St. Brooklyn, NY 11203') }}</a>
                                </li>
                                <li>
                                    <span class="icon mdi mdi-phone"></span>
                                    <a href="tel:{{ config('site.phone', '1-800-346-6277') }}">{{ config('site.phone', '1-800-346-6277') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Language Switcher (Desktop) -->
                    <div class="navbar-lang-switcher navbar-lang-desktop" style="display: flex; gap: 8px; align-items: center; margin-left: 20px;">
                        <a href="{{ route('lang.switch', 'ro') }}" style="display: inline-block; transition: opacity 0.3s ease;">
                            <img src="{{ asset('images/flags/ro.gif') }}" alt="Română" width="28" height="18"
                                 style="{{ app()->getLocale() === 'ro' ? 'border:2px solid #007bff; border-radius: 3px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 3px; opacity: 0.7;' }}">
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" style="display: inline-block; transition: opacity 0.3s ease;">
                            <img src="{{ asset('images/flags/en.gif') }}" alt="English" width="28" height="18"
                                 style="{{ app()->getLocale() === 'en' ? 'border:2px solid #007bff; border-radius: 3px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 3px; opacity: 0.7;' }}">
                        </a>
                    </div>
                </div>
                <div class="rd-navbar-nav-wrap">
                    <ul class="rd-navbar-nav">
                        <li class="rd-nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ route('home') }}">{{__('Home')}}</a>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('about*') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('about') }}">{{__('About')}}</a>
                            <ul class="rd-menu rd-navbar-dropdown">
                                <li class="rd-dropdown-item">
                                    <a class="rd-dropdown-link" href="{{ localized_route('team') }}">{{__('Our Team')}}</a>
                                </li>
                                <li class="rd-dropdown-item">
                                    <a class="rd-dropdown-link" href="{{ localized_route('testimonials') }}">{{__('Testimonials')}}</a>
                                </li>
                                <li class="rd-dropdown-item">
                                    <a class="rd-dropdown-link" href="{{ localized_route('pricing') }}">{{__('Pricing')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('programs*') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('programs') }}">{{__('Programs')}}</a>
                            <ul class="rd-menu rd-navbar-dropdown">
                                <li class="rd-dropdown-item">
                                    <a class="rd-dropdown-link" href="{{ localized_route('programs.show', 1) }}">{{__('Program Page')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('gallery') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('gallery') }}">{{__('Gallery')}}</a>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('webcams') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('webcams') }}">{{__('Webcams')}}</a>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('contact') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('contact') }}">{{__('Contact Us')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
