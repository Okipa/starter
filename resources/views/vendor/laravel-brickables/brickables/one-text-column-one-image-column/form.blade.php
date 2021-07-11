@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ textarea()->name('text_left')
        // Todo: remove the line below if your app is not multilingual.
        ->locales(supportedLocaleKeys())
        ->prepend(null)
        // ToDo: remove localization if your app is not multilingual.
        ->value(fn($locale) => translatedData($brick, 'data.text_left', $locale))
        ->componentHtmlAttributes(['required', 'data-editor']) }}
    @php($image = $brick?->getFirstMedia('images'))
    {{ inputFile()->name('image_right')
        ->value($image?->file_name)
        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $image]))
        ->showRemoveCheckbox(false)
        ->caption($brickable->getBrickModel()->getMediaCaption('images'))
        ->componentHtmlAttributes(['required']) }}
    {{ inputSwitch()->name('invert_order')->checked((bool) data_get($brick, 'data.invert_order')) }}
@endsection
