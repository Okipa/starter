<div class="my-3"><a href="{{ route('download.file', ['path' => $media->getPath(), 'name' => $file->getTranslation('name', $locale)]) }}" title="@lang('Download', [], $locale) {{ $file->getTranslation('name', $locale) }}">{!! $file->icon !!}<span class="mt-1 d-block small"><i class="fas fa-download fa-fw mr-1"></i>@lang('Download', [], $locale) {{ $file->getTranslation('name', $locale) }}</span></a></div>
