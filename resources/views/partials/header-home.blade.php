@php
use Illuminate\Support\Facades\Storage;
@endphp
<!-- Page Header-->
<header class="section page-header page-header-2 section-custom-1-ally">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-creative" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="95px" data-xl-stick-up-offset="95px" data-xxl-stick-up-offset="95px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- Language Switcher and User Profile (Mobile/Tablet) -->
                        <div class="navbar-lang-switcher navbar-lang-mobile" style="display: flex;justify-content: end;width: 100%; gap: 10px; align-items: center; margin-right: 15px; z-index: 1000; order: 1;">
                            <a href="{{ route('lang.switch', 'ro') }}" style="display: inline-block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="{{ asset('images/flags/ro.gif') }}" alt="Română" width="26" height="17"
                                     style="{{ app()->getLocale() === 'ro' ? 'border:2px solid #007bff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 4px; opacity: 0.8; border: 1px solid #ddd;' }}">
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" style="display: inline-block; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="{{ asset('images/flags/en.gif') }}" alt="English" width="26" height="17"
                                     style="{{ app()->getLocale() === 'en' ? 'border:2px solid #007bff; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 4px; opacity: 0.8; border: 1px solid #ddd;' }}">
                            </a>

                            @auth
                                <!-- User Profile Dropdown (Mobile) -->
                                <div class="user-profile-dropdown mobile" style="position: relative;">
                                    <div class="user-avatar" style="
                                        width: 30px;
                                        height: 30px;
                                        border-radius: 50%;
                                        background: linear-gradient(135deg, #007bff, #0056b3);
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        color: white;
                                        font-weight: 600;
                                        font-size: 11px;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        border: 2px solid rgba(255, 255, 255, 0.8);
                                        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
                                    " onclick="toggleUserDropdownMobile()">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ auth()->user()->name ? strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) : '' }}
                                    </div>

                                    <div class="user-dropdown-menu mobile" id="userDropdownMenuMobile" style="
                                        position: absolute;
                                        top: 38px;
                                        right: 0;
                                        background: rgba(255, 255, 255, 0.95);
                                        backdrop-filter: blur(10px);
                                        border-radius: 12px;
                                        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                                        border: 1px solid rgba(255, 255, 255, 0.2);
                                        min-width: 180px;
                                        display: none;
                                        z-index: 1000;
                                        overflow: hidden;
                                    ">
                                        <div style="padding: 12px 16px; border-bottom: 1px solid rgba(0, 0, 0, 0.1); background: rgba(0, 123, 255, 0.05);">
                                            <div style="font-weight: 600; color: #333; font-size: 14px;">{{ auth()->user()->name }}</div>
                                            <div style="font-size: 12px; color: #666; margin-top: 2px;">{{ auth()->user()->email }}</div>
                                        </div>

                                        @can('access-admin')
                                            <a href="{{ route('dashboard') }}" style="
                                                display: block;
                                                padding: 10px 16px;
                                                color: #333;
                                                text-decoration: none;
                                                font-size: 14px;
                                                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                                            ">
                                                <i class="mdi mdi-view-dashboard" style="margin-right: 8px;"></i>{{ __('Dashboard') }}
                                            </a>
                                        @endcan

                                        <a href="{{ route('password.change') }}" style="
                                            display: block;
                                            padding: 10px 16px;
                                            color: #333;
                                            text-decoration: none;
                                            font-size: 14px;
                                            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                                        ">
                                            <i class="mdi mdi-lock-reset" style="margin-right: 8px;"></i>{{ __('Change Password') }}
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" style="
                                                display: block;
                                                width: 100%;
                                                padding: 10px 16px;
                                                background: none;
                                                border: none;
                                                color: #dc3545;
                                                text-align: left;
                                                font-size: 14px;
                                                cursor: pointer;
                                            ">
                                                <i class="mdi mdi-logout" style="margin-right: 8px;"></i>{{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endauth
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
                            @if(!empty($company->logo_path))
                            <a class="brand" href="{{ route('home') }}">
                                <img class="brand-logo" src="{{ Storage::disk('public')->url($company->logo_path) }}" alt="{{ config('app.name') }}" width="35" />
                            </a>
                            @endif
                        </div>

                    </div>
                    <div class="rd-navbar-aside-outer">
                        <!-- Language Switcher and User Profile (Desktop) -->
                        <div class="navbar-lang-switcher navbar-lang-desktop" style="display: flex; gap: 8px; align-items: center; margin-left: 20px;">
                            <a href="{{ route('lang.switch', 'ro') }}" style="display: inline-block; transition: opacity 0.3s ease;">
                                <img src="{{ asset('images/flags/ro.gif') }}" alt="Română" width="28" height="18"
                                     style="{{ app()->getLocale() === 'ro' ? 'border:2px solid #007bff; border-radius: 3px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 3px; opacity: 0.7;' }}">
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" style="display: inline-block; transition: opacity 0.3s ease;">
                                <img src="{{ asset('images/flags/en.gif') }}" alt="English" width="28" height="18"
                                     style="{{ app()->getLocale() === 'en' ? 'border:2px solid #007bff; border-radius: 3px; box-shadow: 0 2px 4px rgba(0,123,255,0.3);' : 'border-radius: 3px; opacity: 0.7;' }}">
                            </a>

                            @auth
                                <!-- User Profile Dropdown -->
                                <div class="user-profile-dropdown" style="position: relative; margin-left: 12px;">
                                    <div class="user-avatar" style="
                                    width: 32px;
                                    height: 32px;
                                    border-radius: 50%;
                                    background: linear-gradient(135deg, #007bff, #0056b3);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: white;
                                    font-weight: 600;
                                    font-size: 12px;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                    border: 2px solid rgba(255, 255, 255, 0.8);
                                    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
                                " onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 15px rgba(0, 123, 255, 0.4)'"
                                         onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 8px rgba(0, 123, 255, 0.3)'"
                                         onclick="toggleUserDropdown()">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ auth()->user()->name ? strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) : '' }}
                                    </div>

                                    <div class="user-dropdown-menu" id="userDropdownMenu" style="
                                    position: absolute;
                                    top: 40px;
                                    right: 0;
                                    background: rgba(255, 255, 255, 0.95);
                                    backdrop-filter: blur(10px);
                                    border-radius: 12px;
                                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                                    border: 1px solid rgba(255, 255, 255, 0.2);
                                    min-width: 180px;
                                    display: none;
                                    z-index: 1000;
                                    overflow: hidden;
                                ">
                                        <div style="padding: 12px 16px; border-bottom: 1px solid rgba(0, 0, 0, 0.1); background: rgba(0, 123, 255, 0.05);">
                                            <div style="font-weight: 600; color: #333; font-size: 14px;">{{ auth()->user()->name }}</div>
                                            <div style="font-size: 12px; color: #666; margin-top: 2px;">{{ auth()->user()->email }}</div>
                                        </div>

                                        @can('access-admin')
                                            <a href="{{ route('dashboard') }}" style="
                                            display: block;
                                            padding: 10px 16px;
                                            color: #333;
                                            text-decoration: none;
                                            font-size: 14px;
                                            transition: background 0.2s ease;
                                            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                                        " onmouseover="this.style.background='rgba(0, 123, 255, 0.1)'"
                                               onmouseout="this.style.background='transparent'">
                                                <i class="mdi mdi-view-dashboard" style="margin-right: 8px;"></i>{{ __('Dashboard') }}
                                            </a>
                                        @endcan

                                        <a href="{{ route('password.change') }}" style="
                                        display: block;
                                        padding: 10px 16px;
                                        color: #333;
                                        text-decoration: none;
                                        font-size: 14px;
                                        transition: background 0.2s ease;
                                        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                                    " onmouseover="this.style.background='rgba(0, 123, 255, 0.1)'"
                                           onmouseout="this.style.background='transparent'">
                                            <i class="mdi mdi-lock-reset" style="margin-right: 8px;"></i>{{ __('Change Password') }}
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" style="
                                            display: block;
                                            width: 100%;
                                            padding: 10px 16px;
                                            background: none;
                                            border: none;
                                            color: #dc3545;
                                            text-align: left;
                                            font-size: 14px;
                                            cursor: pointer;
                                            transition: background 0.2s ease;
                                        " onmouseover="this.style.background='rgba(220, 53, 69, 0.1)'"
                                                    onmouseout="this.style.background='transparent'">
                                                <i class="mdi mdi-logout" style="margin-right: 8px;"></i>{{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endauth
                        </div>
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
                            </ul>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('programs*') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('programs') }}">{{__('Programs')}}</a>
                            <ul class="rd-menu rd-navbar-dropdown">
                                @foreach($skiPrograms as $program)
                                    <li class="rd-dropdown-item">
                                        <a class="rd-dropdown-link" href="{{ localized_route('programs.show', ['slug' => $program->getTranslation('slug', app()->getLocale())]) }}">{{ $program->getTranslation('title', app()->getLocale()) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="rd-nav-item {{ Request::routeIs('camps') ? 'active' : '' }}">
                            <a class="rd-nav-link" href="{{ localized_route('camps') }}">{{__('Camps')}}</a>
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

<script>
function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdownMenu');
    const isVisible = dropdown.style.display !== 'none';
    dropdown.style.display = isVisible ? 'none' : 'block';
}

function toggleUserDropdownMobile() {
    const dropdown = document.getElementById('userDropdownMenuMobile');
    const isVisible = dropdown.style.display !== 'none';
    dropdown.style.display = isVisible ? 'none' : 'block';
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const dropdowns = ['userDropdownMenu', 'userDropdownMenuMobile'];
    dropdowns.forEach(function(id) {
        const dropdown = document.getElementById(id);
        if (dropdown) {
            const profileDiv = dropdown.closest('.user-profile-dropdown');
            if (!profileDiv.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        }
    });
});
</script>
