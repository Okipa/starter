@if($file && $media = $file->getFirstMedia('media'))
    @if($file->can_be_previewed_in_popin)
        <a href="{{ $media->getUrl() }}" title="@lang('Preview') {{ $file->name }}" data-lightbox>
    @else
        <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="@lang('Download') {{ $file->name }}" download>
    @endif
    @if($file->has_preview_image)
        @include('components.admin.media.thumb', ['image' => $media])
    @else
        {!! $file->icon !!}
    @endif
    </a>
@endif
