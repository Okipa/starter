@if(request()->is('admin/*') || request()->is('*/admin/*'))
    <div class="container">
        <div class="row">
            <div class="col my-3">
                <i class="fas fa-info-circle fa-fw text-info"></i> {{ __($brick->brickable->getLabel()) }}.
            </div>
        </div>
    </div>
@endif
<div class="container">
    <div class="row mb-n3">
        <div class="col-md-4 text">
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_left')) !!}
        </div>
        <div class="col-md-4 text">
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_center')) !!}
        </div>
        <div class="col-md-4 text">
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_right')) !!}
        </div>
    </div>
</div>
