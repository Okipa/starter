@if($url && $active)
    <a href="{{ $url }}" class="btn btn-sm btn-outline-primary new-window">
        <i class="fas fa-external-link-square-alt fa-fw"></i>
        @lang('Link')
    </a>
@endif
