<nav id="navbar" class="navbar navbar-expand-xl navbar-dark bg-dark w-100">
    <a class="navbar-brand d-flex align-items-center ps-3 pe-3" href="{{ route('admin.index') }}">
        @if($icon = settings()->getFirstMedia('icons'))
            {{ $icon('admin') }}
        @endif
        <span class="{{ $icon ? 'ps-2' : null }}">{{ config('app.name') }}</span>
    </a>
    <button class="navbar-toggler navbar-toggler-end collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-target="#sidenav"
            aria-controls="sidenav"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @include('layouts.admin.partials.nav-top')
    @include('layouts.admin.partials.nav-side')
</nav>
