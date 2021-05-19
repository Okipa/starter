@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="py-3">
            <i class="fas fa-arrows-alt-v fa-fw"></i>
            {{ __(App\View\Components\Front\Spacer::TYPES[$brick['data']['type']]['label']) }} {{ strtolower(__($brick->brickable->getLabel())) }}.
        </div>
    </div>
@else
    <x-front.spacer :typeKey="$brick['data']['type']"/>
@endif
