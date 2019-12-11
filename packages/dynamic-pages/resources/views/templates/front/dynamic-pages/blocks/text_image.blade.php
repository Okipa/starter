<div class="row">
    <div class="col-md-6">
        {!! (new Parsedown)->text($blockable->content) !!}
    </div>
    <div class="col-md-6">
        <img src="{{ $blockable->getFirstMediaUrl('text_images') }}" alt="" class="w-100">
    </div>
</div>
