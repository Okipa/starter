{{ button()->prepend('<i class="fas fa-link fa-fw"></i>')
    ->label(__('URL'))
    ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
    ->componentHtmlAttributes(['data-library-media-id' => $file->id, 'data-type' => 'url']) }}
@foreach(supportedLocaleKeys() as $localeKey)
    {{ button()->prepend('<i class="fas fa-code fa-fw"></i>')
        ->label(__('HTML') . ' (' . strtoupper($localeKey). ')')
        ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
        ->componentHtmlAttributes([
            'data-library-media-id' => $file->id,
            'data-type' => 'html',
            'data-locale' => $localeKey
        ]) }}
@endforeach
