@if(app()->environment('local'))
    <li class="nav-item">
        <a class="nav-link new-window"
           href="/telescope"
           title="@lang('Debug assistant.')">
            <i class="fas fa-binoculars fa-fw text-success"></i>
            @lang('Telescope')
        </a>
    </li>
@endif
