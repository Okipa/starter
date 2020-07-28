@php
    $contactPageActive = currentRouteIs('contact.page.edit')
        || optional(Brickables::getModelFromRequest())->unique_key === 'contact_page_content';
    $subMenuActive = $contactPageActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#contact-menu"
       title="@lang('Contact')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="contact-menu">
        <i class="fas fa-envelope fa-fw"></i>
        @lang('Contact')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="contact-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link {{ $contactPageActive ? 'active' : null }}"
               href="{{ route('contact.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
    </ul>
</li>
