@if(app()->environment('local'))
    <li class="nav-item">
        <a class="nav-link"
           href="/telescope"
           title="@lang('Debug assistant.')"
           data-new-window>
            <i class="fas fa-binoculars fa-fw text-success"></i>
            @lang('Telescope')
        </a>
    </li>
@endif
