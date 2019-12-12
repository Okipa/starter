<div class="row">
    <div class="col-md-6">
        <img src="{{ $blockable->getFirstMediaUrl('text_images') }}"
             alt="{{ $blockable->getFirstMedia('text_images')['name'] }}"
             class="w-100">
    </div>
    <div class="col-md-6">
        {!! (new Parsedown)->text($blockable->content) !!}
    </div>
</div>
