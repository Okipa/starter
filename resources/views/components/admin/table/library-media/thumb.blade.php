@if($media = $libraryMedia->getFirstMedia('medias'))
    @if(Str::contains($media->mime_type, 'image') || Str::contains($media->mime_type, 'pdf'))
        {{ image()->src($media->getUrl('thumb'))->linkUrl($media->getUrl()) }}
    @elseif(Str::contains($media->mime_type, 'video'))
        <a href="{{ $media->getUrl() }}" title="{{ $media->name }}" data-lity>
            {!! config('library-media.icons.video') !!}
        </a>
    @elseif(Str::contains($media->mime_type, 'audio'))
        <a href="{{ $media->getUrl() }}" title="{{ $media->name }}" data-lity>
            {!! config('library-media.icons.audio') !!}
        </a>
    @else
        <a href="{{ $media->getUrl() }}" title="{{ $media->name }}" data-lity>
            {!! config('library-media.icons.file') !!}
        </a>
    @endif
@endif
