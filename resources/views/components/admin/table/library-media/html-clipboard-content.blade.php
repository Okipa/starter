@if($media = $file->getFirstMedia('medias'))
@if($file->canBeDisplayed && ! $file->downloadable)
{{-- display --}}
<div class="my-3">
@if($file->type === 'image')
    <img src="{{ $media->getUrl() }}" alt="{{ $file->name }}">
@elseif($file->type === 'pdf')
    <a href="{{ $media->getUrl() }}" title="@lang('Preview') {{ $file->name }}" data-lity>
        <img src="{{ $media->getUrl('thumb') }}" alt="{{ $file->name }}">
        <span class="mt-1 d-block small"><i class="fas fa-search fa-fw"></i>{{ $file->name }}</span>
    </a>
@elseif($file->type === 'audio')
    <audio controls preload="1">
        <source src="/storage/14/test.mp3?v=1574955679">
        Your browser does not support the audio tag.
    </audio>
@elseif($file->type === 'video')
    <video controls preload="1">
        <source src="{{ $media->getUrl() }}">
        Your browser does not support the video tag.
    </video>
@endif
</div>
@else
{{-- download --}}
<div class="my-3">
    <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="@lang('Download') {{ $file->name }}">
        {!! $file->icon !!}
        <span class="mt-1 d-block small"><i class="fas fa-download fa-fw"></i>{{ $file->name }}</span>
    </a>
</div>
@endif
@endif
