<li class="nav-item {{ request()->route()->getName() === 'home' ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('home') }}"
       title="@lang('nav.front.home')">
        @lang('nav.front.home')
    </a>
</li>
