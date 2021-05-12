@php($htmlTag = App\Brickables\Title::TYPES[translatedData($brick, 'data.type')]['html_tag'])
<div class="container">
    <div class="row">
        <div class="col-12">
            <{!! $htmlTag !!} class="text-secondary m-0">{{ translatedData($brick, 'data.title') }}</{!! $htmlTag !!}>
            <hr class="mb-0">
        </div>
    </div>
</div>
