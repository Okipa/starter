@php
    $type = App\View\Components\Front\Spacer::TYPES[$brick['data']['type']];
@endphp
@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="col my-3">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }} - {{ __('Type:') }} {{ __($type['label']) }}.
            </div>
        </div>
    </div>
@else
    <x-front.spacer :typeKey="$type['key']"/>
@endif
