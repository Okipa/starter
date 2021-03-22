<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('cookie.services.index')
        || currentRouteIs('cookie.service.create')
        || currentRouteIs('cookie.service.edit') ? ' active' : null }}"
       href="{{ route('cookie.services.index') }}"
       title="{{ __('Service cookies') }}">
        <i class="fas fa-cookie-bite fa-fw"></i>
        {{ __('Service cookies') }}
    </a>
</li>
