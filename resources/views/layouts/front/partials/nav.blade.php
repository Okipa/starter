<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.page.show') }}" title="{{ config('app.name') }}">
            @if($icon = settings()->getFirstMedia('icon'))
                {{ $icon('front') }}
            @endif
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-target="#navbarToggler"
                aria-controls="navbarToggler"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                @include('layouts.front.partials.nav.home')
                @include('layouts.front.partials.nav.news')
                @include('layouts.front.partials.nav.contact')
            </ul>
            <ul class="navbar-nav">
                @include('layouts.front.partials.nav.language')
            </ul>
        </div>
    </div>
</nav>
