<div class="row">
    <div class="col-md-6">
        <p>{{ $blockable->content }}</p>
    </div>
    <div class="col-md-6">
        <img src="{{ $blockable->getFirstMediaUrl('paragraph_images') }}" alt="" class="w-100">
    </div>
</div>
