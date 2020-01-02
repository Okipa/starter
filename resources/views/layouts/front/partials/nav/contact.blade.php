<li class="nav-item {{ Str::contains(request()->route()->getName(), ['contact']) ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('contact') }}"
       title="@lang('Contact')">
        @lang('Contact')
    </a>
</li>
