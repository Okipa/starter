<div class="row">
    <div class="col-md-6">
        <img src="{{ $blockable->getFirstMediaUrl('paragraph_images') }}" alt="{{ $blockable->getFirstMedia('paragraph_images')['name'] }}" class="w-100">
    </div>
    <div class="col-md-6">
        <p>{{ $blockable->content }}</p>
    </div>
</div>
