@if($media = $libraryMedia->getFirstMedia('medias'))
@if($libraryMedia->canBeDisplayed && ! $libraryMedia->downloadable)
{{-- display --}}
<div class="my-3">
@if($libraryMedia->type === 'image')
    <img src="{{ $media->getUrl() }}" alt="{{ $libraryMedia->name }}">
@elseif($libraryMedia->type === 'pdf')
    <a href="{{ $media->getUrl() }}" title="{{ __('library-media.actions.preview', ['name' => $libraryMedia->name]) }}" data-lity>
        <img src="{{ $media->getUrl('thumb') }}" alt="{{ $libraryMedia->name }}">
        <span class="mt-1 d-block small"><i class="fas fa-search fa-fw"></i>{{ $libraryMedia->name }}</span>
    </a>
@elseif($libraryMedia->type === 'audio')
    <audio controls preload="1">
        <source src="/storage/14/test.mp3?v=1574955679">
        Your browser does not support the audio tag.
    </audio>
@elseif($libraryMedia->type === 'video')
    <video controls preload="1">
        <source src="{{ $media->getUrl() }}">
        Your browser does not support the video tag.
    </video>
@endif
</div>
@else
{{-- download --}}
<div class="my-3">
    <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="{{ __('library-media.actions.download', ['name' => $libraryMedia->name]) }}">
        {!! $libraryMedia->icon !!}
        <span class="mt-1 d-block small"><i class="fas fa-download fa-fw"></i>{{ $libraryMedia->name }}</span>
    </a>
</div>
@endif
@endif
