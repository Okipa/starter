@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ select()->name('type')
        ->options(array_map(static fn(array $type) => [
            'key' => $type['key'],
            'label' => __($type['label'])
        ], App\View\Components\Front\Spacer::TYPES), 'key', 'label')
        ->disablePlaceholder()
        ->selectOptions('key', data_get($brick, 'data.type'))
        ->componentHtmlAttributes(['required']) }}
@endsection
