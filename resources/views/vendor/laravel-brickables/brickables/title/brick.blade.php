@php
    $type = App\View\Components\Front\Title::TYPES[$brick['data']['type']];
    $style = App\View\Components\Front\Title::STYLES[$brick['data']['style']];
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="col mb-2">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }} - {{ __('Type:') }} {{ __($type['label']) }} - {{ __('Style:') }} {{ __($style['label']) }}.
            </div>
        </div>
    </div>
@endif
<x-front.title :typeKey="$type['key']" :styleKey="$style['key']" :title="translatedData($brick, 'data.title')"/>
