{{ button()->prepend('<i class="fas fa-link fa-fw"></i>')
    ->label(__('URL'))
    ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
    ->componentHtmlAttributes(['data-library-media-id' => $file->id, 'data-type' => 'url']) }}
{{-- Todo: remove foreach loop if your app is not multilingual --}}
@foreach(supportedLocaleKeys() as $localeKey)
    @if($file->can_be_displayed_on_page)
        {{ button()->prepend('<i class="fas fa-code fa-fw"></i>')
            ->label(__('HTML Display') . (multilingual() ? ' (' . strtoupper($localeKey). ')' : ''))
            ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
            ->componentHtmlAttributes([
                'data-library-media-id' => $file->id,
                'data-type' => 'display',
                'data-locale' => $localeKey
            ]) }}
    @endif
    {{ button()->prepend('<i class="fas fa-code fa-fw"></i>')
        ->label(__('HTML Download') . (multilingual() ? ' (' . strtoupper($localeKey). ')' : ''))
        ->componentClasses(['btn-outline-primary',  'btn-sm', 'm-1', 'clipboard-copy'])
        ->componentHtmlAttributes([
            'data-library-media-id' => $file->id,
            'data-type' => 'download',
            'data-locale' => $localeKey
        ]) }}
@endforeach
