@if($media = $file->getFirstMedia('medias'))
    @if($file->canBeDisplayed)
        <a href="{{ $media->getUrl() }}" title="@lang('Preview') {{ $file->name }}" data-lity>
            @if(in_array($file->type, ['image', 'pdf']))
                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $file->name }}">
            @elseif(in_array($file->type, ['video', 'audio']))
                {!! $file->icon !!}
            @endif
        </a>
    @else
        <a href="{{ route('download.file', ['path' => $media->getPath()]) }}" title="@lang('Download') {{ $file->name }}">
            {!! $file->icon !!}
        </a>
    @endif
@endif
