@switch($file->type)
@case('image')
<div class="my-3">{!! $media->img('', ['class' => 'img-fluid', 'alt' => $file->getTranslation('name', $locale)]) !!}</div>
@break
@case('audio')
<div class="my-3"><a href="{{ $media->getUrl() }}" title="@lang('Preview') {{ $file->getTranslation('name', $locale) }}" data-lity><img src="{{ $media->getUrl('thumb') }}" alt="{{ $file->getTranslation('name', $locale) }}"><span class="mt-1 d-block small"><i class="fas fa-search fa-fw"></i>{{ $file->getTranslation('name', $locale) }}</span></a></div>
@break
@case('video')
<div class="my-3"><video controls preload="1"><source src="{{ $media->getUrl() }}">@lang('Your browser does not support the video tag.')</video></div>
@break
@endswitch
