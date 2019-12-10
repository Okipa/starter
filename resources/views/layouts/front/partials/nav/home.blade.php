<li class="nav-item {{ request()->route()->getName() === 'home' ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('home') }}"
       title="@lang('Home')">
        <i class="fas fa-home fa-fw"></i>
        @lang('nav.front.home')
    </a>
</li>
