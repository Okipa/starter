<div class="container">
    <div class="text mb-n3">
        {{-- ToDo: replace `translatedData` by `data_get` if your app is not multilingual --}}
        {!! (new Parsedown)->text(translatedData($brick, 'data.text')) !!}
    </div>
</div>
