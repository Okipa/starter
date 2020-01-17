<div class="row">
    <div class="col-12">
        {!! (new Parsedown)->text(data_get($brick, 'data.text.' . app()->getLocale())) !!}
    </div>
</div>
