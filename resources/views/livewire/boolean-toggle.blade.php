<div>
    {{ inputSwitch()->componentId('bool-toggle-' . $model->id)
        ->name($field)
        ->model($model)
        ->label(null)
        ->componentHtmlAttributes([
            'wire:key' => uniqid('bool-toggle-' . $model->id, true),
            'wire:click' => 'toggle',
        ]) }}
</div>
