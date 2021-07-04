@if($media)
    <a href="{{ $media->getUrl() }}" title="{{ $media->file_name }}" data-lightbox>
        {{ $media->img('thumb', ['class' => 'rounded-circle', 'alt' => $media->file_name]) }}
    </a>
@endif
