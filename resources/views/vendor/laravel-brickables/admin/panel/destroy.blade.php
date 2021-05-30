<form class="ms-1"
      method="POST"
      action="{{ $brick->brickable->getDestroyRoute($brick) }}"
      novalidate>
    @csrf
    @method('DELETE')
    <input type="hidden" name="admin_panel_url" value="{{ url()->current() }}#bricks-admin-panel">
    <button class="btn btn-link p-0 text-danger" type="submit" title="{{ __('Destroy') }}" data-confirm="{{ __('crud.orphan.destroy_confirm', [
        'entity' => __('Content bricks'),
        'name' => __($brick->brickable->getLabel()),
    ]) }}">
        <i class="fas fa-trash fa-fw"></i>
    </button>
</form>
