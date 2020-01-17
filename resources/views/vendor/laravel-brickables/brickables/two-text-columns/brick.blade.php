<div class="row">
    <div class="col-md-6">
        {!! (new Parsedown)->text(data_get($brick, 'data.left_text' . app()->getLocale())) !!}
    </div>
    <div class="col-md-6">
        {!! (new Parsedown)->text(data_get($brick, 'data.right_text' . app()->getLocale())) !!}
    </div>
</div>
