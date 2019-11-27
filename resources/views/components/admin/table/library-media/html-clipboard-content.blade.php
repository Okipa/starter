@if($media = $libraryMedia->getFirstMedia('medias'))
    @php
        $imageType = Str::contains($media->mime_type, 'image') || Str::contains($media->mime_type, 'pdf');
        $videoType = Str::contains($media->mime_type, 'video');
        $audioType = Str::contains($media->mime_type, 'audio');
        $downloadable = $libraryMedia->downloadable || (! $imageType || ! $videoType || ! $audioType);
    @endphp
    @if($downloadable)
        <a class="d-flex" href="{{ route('download.file', ['path' => $media->getPath()]) }}"
           title="{{ $libraryMedia->name }}">
            @if(Str::contains($media->mime_type, 'image') || Str::contains($media->mime_type, 'pdf'))
                {!! config('library-media.icons.image') !!}
            @elseif(Str::contains($media->mime_type, 'video'))
                {!! config('library-media.icons.video') !!}
            @elseif(Str::contains($media->mime_type, 'audio'))
                {!! config('library-media.icons.audio') !!}
            @else
                {!! config('library-media.icons.file') !!}
            @endif
            @lang('library-media.download', ['name' => $libraryMedia->name])
        </a>
    @else
        @if(Str::contains($media->mime_type, 'image') || Str::contains($media->mime_type, 'pdf'))
            {{ image()->src($media->getUrl()) }}
        @elseif(Str::contains($media->mime_type, 'video'))
            {{ video()->src($media->getUrl()) }}
        @elseif(Str::contains($media->mime_type, 'audio'))
            {{ audio()->src($media->getUrl()) }}
        @endif
    @endif
@endif
