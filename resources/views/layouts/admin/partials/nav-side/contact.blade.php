@php
    $contactPageActive = in_array(request()->route()->getName(), ['contact.page.edit']);
    $subMenuActive = $contactPageActive;
@endphp
<li class="nav-item">
    <a{{ classTag('nav-link', $subMenuActive ? 'active' : null) }}
       href="#contactMenu"
       title="@lang('nav.admin.home')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-envelope fa-fw"></i>
        @lang('nav.admin.contact')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="contactMenu" {{ classTag(['collapse', 'list-unstyled', $subMenuActive ? 'show' : null]) }}>
        {{-- page --}}
        <li class="nav-item">
            <a{{ classTag(['nav-link', 'load-on-click', $contactPageActive ? 'active' : null]) }}
               href="{{ route('contact.page.edit') }}"
               title="@lang('nav.admin.page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('nav.admin.page')
            </a>
        </li>
    </ul>
</li>
