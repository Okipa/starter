@if($url && $active)
    {{ buttonLink()->url($url)
        ->prepend('<i class="fas fa-external-link-square-alt fa-fw"></i>')
        ->label(__('Display'))
        ->componentClasses(['btn-sm', 'btn-outline-primary'])
        ->componentHtmlAttributes(['data-new-window']) }}
@endif
