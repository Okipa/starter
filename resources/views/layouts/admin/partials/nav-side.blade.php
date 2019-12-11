<div id="sidenav" class="collapse navbar-collapse bg-dark align-items-start py-3">
    <ul class="navbar-nav nav flex-column flex-fill w-100">
        @include('layouts.admin.partials.nav-side.dashboard')
        @include('layouts.admin.partials.nav-side.home')
        @include('layouts.admin.partials.nav-side.news')
        @include('dynamic-pages::layouts.admin.partials.nav-side.dynamic-pages')
        @include('layouts.admin.partials.nav-side.simple-pages')
        @include('layouts.admin.partials.nav-side.library-media')
        <hr class="w-100">
        @include('layouts.admin.partials.nav-side.users')
        @include('layouts.admin.partials.nav-side.settings')
        {{-- separator --}}
        <hr class="w-100">
        {{-- back to the front --}}
        <li class="nav-item">
            <a class="nav-link new-window" href="{{ route('home') }}" title="@lang('nav.admin.users')">
                <i class="fas fa-undo fa-fw"></i>
                @lang('nav.admin.back')
            </a>
        </li>
    </ul>
</div>
