@if($media = $libraryMedia->getFirstMedia('medias'))
    @if($libraryMedia->canBeDisplayed)
        <a href="{{ $media->getUrl() }}" title="{{ __('library-media.actions.preview', ['name' => $libraryMedia->name]) }}" data-lity>
            @if(in_array($libraryMedia->type, ['image', 'pdf']))
                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $libraryMedia->name }}">
            @elseif(in_array($libraryMedia->type, ['video', 'audio']))
                {!! $libraryMedia->icon !!}
            @endif
        </a>
    @else
        <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="{{ __('library-media.actions.download', ['name' => $libraryMedia->name]) }}">
            {!! $libraryMedia->icon !!}
        </a>
    @endif
@endif
