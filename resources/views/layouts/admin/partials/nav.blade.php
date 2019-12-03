<nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark w-100 fixed-top">
    <a class="navbar-brand d-flex align-items-center pl-3 pr-3" href="{{ route('admin') }}">
        @if($icon = $settings->getFirstMedia('icon'))
            {{ $icon('admin-header') }}
        @endif
        <span {{ classTag($icon ? 'pl-2' : null) }}>{{ config('app.name') }}</span>
    </a>
    <button class="navbar-toggler navbar-toggler-right collapsed"
            type="button"
            data-toggle="collapse"
            data-target="#sidenav"
            aria-controls="sidenav"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @include('layouts.admin.partials.nav-top')
    @include('layouts.admin.partials.nav-side')
</nav>
