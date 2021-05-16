@php
    $type = App\Brickables\Title::TYPES[$brick['data']['type']];
    $style = App\Brickables\Title::STYLES[$brick['data']['style']];
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="col mb-2">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __('Type') }} {{ __($type['label']) }} - {{ __('Style') }} {{ __($style['label']) }}
            </div>
        </div>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col">
            @switch($type['key'])
                @case('h1')
                    <x-front.title-h1 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
                @case('h2')
                    <x-front.title-h2 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
                @case('h3')
                    <x-front.title-h3 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
                @case('h4')
                    <x-front.title-h4 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
                @case('h5')
                    <x-front.title-h5 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
                @case('h6')
                    <x-front.title-h6 :class="$style['classes']" :title="translatedData($brick, 'data.title')"/>
                @break
            @endswitch
        </div>
    </div>
</div>
