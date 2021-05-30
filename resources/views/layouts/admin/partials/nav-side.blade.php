<div id="sidenav" class="collapse navbar-collapse bg-dark align-items-start py-3">
    <ul class="navbar-nav nav flex-column flex-fill">
        @include('layouts.admin.partials.nav-side.dashboard')
        <hr class="w-100">
        @include('layouts.admin.partials.nav-side.home')
        @include('layouts.admin.partials.nav-side.news')
        @include('layouts.admin.partials.nav-side.contact')
        @include('layouts.admin.partials.nav-side.pages')
        @include('layouts.admin.partials.nav-side.library-media')
        <hr class="w-100">
        @include('layouts.admin.partials.nav-side.users')
        @include('layouts.admin.partials.nav-side.settings')
        @include('layouts.admin.partials.nav-side.cookies')
        <hr class="w-100">
        <li class="nav-item">
            <a class="nav-link"
               href="{{ route('home.page.show') }}"
               title="{{ __('Back to the front') }}"
               target="_blank">
                <i class="fas fa-undo fa-fw"></i>
                {{ __('Back to the front') }}
            </a>
        </li>
    </ul>
</div>
