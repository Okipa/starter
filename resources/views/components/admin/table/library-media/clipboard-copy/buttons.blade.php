{{ button()->prepend('<i class="fas fa-link fa-fw"></i>')
    ->label(__('URL'))
    ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
    ->componentHtmlAttributes(['data-library-media-id' => $file->id, 'data-type' => 'url']) }}
@foreach(supportedLocaleKeys() as $localeKey)
    @if($file->is_displayable)
        {{ button()->prepend('<i class="fas fa-code fa-fw"></i>')
            ->label(__('HTML Display') . ' (' . strtoupper($localeKey). ')')
            ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
            ->componentHtmlAttributes([
                'data-library-media-id' => $file->id,
                'data-type' => 'display',
                'data-locale' => $localeKey
            ]) }}
    @endif
    {{ button()->prepend('<i class="fas fa-code fa-fw"></i>')
        ->label(__('HTML Download') . ' (' . strtoupper($localeKey). ')')
        ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
        ->componentHtmlAttributes([
            'data-library-media-id' => $file->id,
            'data-type' => 'download',
            'data-locale' => $localeKey
        ]) }}
@endforeach
