@if($media = $libraryMedia->getFirstMedia('medias'))
    @if(in_array($libraryMedia->type, ['image', 'pdf']))
        <a href="{{ $media->getUrl() }}" title="{{ __('library-media.actions.preview', ['name' => $libraryMedia->name]) }}" data-lity>
            <img src="{{ $media->getUrl('thumb') }}" alt="{{ $libraryMedia->name }}">
        </a>
    @elseif(in_array($libraryMedia->type, ['video', 'audio']))
        <a href="{{ $media->getUrl() }}" title="{{ __('library-media.actions.preview', ['name' => $libraryMedia->name]) }}" data-lity>
            {!! $libraryMedia->icon !!}
        </a>
    @else
        <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="{{ __('library-media.actions.download', ['name' => $libraryMedia->name]) }}">
            {!! $libraryMedia->icon !!}
        </a>
    @endif
@endif
