@php
    $contactPageActive = Str::contains(request()->route()->getName(), ['contact.page.edit']);
    $subMenuActive = $contactPageActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
       href="#contactMenu"
       title="@lang('Contact')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-envelope fa-fw"></i>
        @lang('Contact')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="contactMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $contactPageActive ? 'active' : null }}"
               href="{{ route('contact.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
    </ul>
</li>
