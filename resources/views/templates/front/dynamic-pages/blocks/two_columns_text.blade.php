<div class="row">
    <div class="col-md-6">
        {!! (new Parsedown)->text($blockable->content_left) !!}
    </div>
    <div class="col-md-6">
        {!! (new Parsedown)->text($blockable->content_right) !!}
    </div>
</div>
