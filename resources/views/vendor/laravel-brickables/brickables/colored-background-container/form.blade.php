@extends('laravel-brickables::admin.form.layout')
@section('inputs')
    {{ select()->name('background_color')
        ->options(App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS, 'key', 'label')
        ->options(array_map(static fn(array $color) => [
            'key' => $color['key'],
            'label' => __($color['label'])
        ], App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS), 'key', 'label')
        ->selectOptions('key', data_get($brick, 'data.background_color'))
        ->componentHtmlAttributes(['required']) }}
    {{ select()->name('alignment')
        ->options(App\Brickables\ColoredBackgroundContainer::ALIGNMENTS, 'key', 'label')
        ->options(array_map(static fn(array $alignment) => [
            'key' => $alignment['key'],
            'label' => __($alignment['label'])
        ], App\Brickables\ColoredBackgroundContainer::ALIGNMENTS), 'key', 'label')
        ->selectOptions('key', data_get($brick, 'data.alignment'))
        ->componentHtmlAttributes(['required']) }}
@endsection
@section('append')
    <hr>
    <div class="mt-3">
        @if($brick)
            {!! $brick->displayAdminPanel() !!}
        @else
            @include('components.admin.brickables.manage-content-once-created')
        @endif
    </div>
@endsection
