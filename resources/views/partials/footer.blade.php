@php
use Illuminate\Support\Facades\Storage;
@endphp
<!-- Page Footer-->
<footer class="section footer-classic footer-classic-md">
    <div class="footer-classic-main">
        <div class="container">
            <div class="footer-classic-layout justify-content-sm-around justify-content-md-between">
                <div class="footer-classic-layout-item">
                    <!-- Brand -->
                    @if(!empty($company->logo_path))
                        <a class="brand" href="{{ localized_route('home') }}">
                            <img class="brand-logo" src="{{ Storage::disk('public')->url($company->logo_path) }}" alt="{{ $company->name }}" style="height: 80px;"/>
                        </a>
                    @endif
                    <div class="footer-classic-item-block footer-classic-item-block-1">
                        <p class="text-white-07 block-1">
                            {{ $company->description ?? config('site.description', 'SkiUp ski school provides a variety of courses and activities for learners of any age and skill level. With us, you\'ll be skiing confidently in no time.') }}
                        </p>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h4 class="footer-classic-title inset-3">{{__('regulations')}}</h4>
                    <div class="footer-classic-item-block footer-classic-item-block-3">
                        <ul class="list-marked__creative">
                            @foreach($footerRegulations as $regulation)
                                <li><a href="{{ localized_route('regulations.show', ['slug' => $regulation->slug]) }}">{{ $regulation->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="footer-classic-layout-item">
                    <h4 class="footer-classic-title inset-3">{{__("Contact Us")}}</h4>
                    <div class="footer-classic-item-block">
                        <ul class="list list-1">
                            <li><a href="{{ localized_route('contact') }}">{{__("Send a Message")}}</a></li>
                        </ul>
                        @if(!empty($footerCompany->socials))
                        <ul class="list-inline list-inline-md">
                            @foreach($footerCompany->socials as $socialLink)
                                @if(isset($socialLink['platform']) && isset($socialLink['url']))
                                    @if($socialLink['platform'] === 'instagram')
                                        <li>
                                            <a class="link-2 icon mdi mdi-instagram" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'facebook')
                                        <li>
                                            <a class="link-2 icon mdi mdi-facebook" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'youtube')
                                        <li>
                                            <a class="link-2 icon mdi mdi-youtube-play" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'twitter')
                                        <li>
                                            <a class="link-2 icon mdi mdi-twitter" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'linkedin')
                                        <li>
                                            <a class="link-2 icon mdi mdi-linkedin" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'tiktok')
                                        <li>
                                            <a class="link-2 icon mdi mdi-tiktok" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @elseif($socialLink['platform'] === 'website')
                                        <li>
                                            <a class="link-2 icon mdi mdi-web" href="{{ $socialLink['url'] }}"></a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                        @endif
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
                @if(!empty($footerCompany->name))
                    <span>{{ $footerCompany->name }}</span>
                @endif
                <span>. {{__("All rights reserved")}}.&nbsp;</span>
                <a href="{{ localized_route('privacy-policy') }}">{{__("Privacy Policy")}}</a>
            </p>
        </div>
    </div>
</footer>
