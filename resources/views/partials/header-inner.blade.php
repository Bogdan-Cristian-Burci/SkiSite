{{-- resources/views/partials/header-inner.blade.php --}}
<header class="section page-header page-header-1 context-dark m-parallax">
    <div class="page-header-1-figure m-parallax-figure">
        <div class="page-header-1-image m-parallax-image" style="background-image: url('{{ $headerImageUrl }}');"></div>
    </div>
    @include('partials.navbar-inner')
    <section class="breadcrumbs-custom">
        <div class="breadcrumbs-custom-inner">
            <div class="container">
                <div class="breadcrumbs-custom-main m-parallax-content">
                    <h2 class="breadcrumbs-custom-title">@yield('title', config('app.name'))</h2>
                    <p>@yield('subtitle')</p>
                </div>
            </div>
        </div>
    </section>
</header>
