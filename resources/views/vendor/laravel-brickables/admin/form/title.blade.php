<h1>
    <i class="fas fa-th-large fa-fw"></i>
    @if($brick)
        {{ __('breadcrumbs.parent.edit', ['parent' => $model->getReadableClassName(), 'entity' => __('Content bricks'), 'detail' => $brickable->getLabel()]) }}
    @else
        {{ __('breadcrumbs.parent.create', ['parent' => $model->getReadableClassName(), 'entity' => __('Content bricks') . ' > ' . $brickable->getLabel()]) }}
    @endif
</h1>
<hr>
