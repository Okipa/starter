@switch($file->type)
@case('image')
<div class="my-3">{!! $media->img('', ['class' => 'img-fluid', 'alt' => $file->name]) !!}</div>
@break
@case('audio')
<div class="my-3"><audio controls><source src="{{ $media->getUrl() }}" type="{{ $media->mime_types }}"/>@lang('Your browser does not support the audio tag.')</audio></div>
@break
@case('video')
<div class="my-3"><video controls><source src="{{ $media->getUrl() }}">@lang('Your browser does not support the video tag.')</video></div>
@break
@endswitch
