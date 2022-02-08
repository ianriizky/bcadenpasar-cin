@include('monitoring.target.form', [
    'target' => $target,
    'url' => route('monitoring.target.edit', $target),
    'icon' => 'fa-edit',
    'title' => __('Edit :name', ['name' => __('menu.target')]),
    'submit_action' => route('monitoring.target.update', $target),
    'destroy_action' => route('monitoring.target.destroy', $target),
    'method' => 'PUT',
])
