@extends('laravel-brickables::admin.form.layout')
@section('title')
    @lang('Carousel configuration')
@endsection
@section('inputs')
    {{ inputToggle()->name('full_width')->checked((bool) data_get($brick, 'data.full_width')) }}
@endsection
@section('append')
    <hr class="mt-n1">
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="m-0">
                @lang('Slides')
            </h2>
        </div>
        <div class="card-body">
            @if($brick)
                @include('components.admin.table.drag-and-drop')
                {{ $table }}
            @else
                <i class="fas fa-info-circle fa-fw text-info"></i>
                @lang('Slides management will be available after the brick creation.')
            @endif
        </div>
    </div>
@endsection
