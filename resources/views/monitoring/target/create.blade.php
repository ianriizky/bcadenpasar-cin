@include('monitoring.target.form', [
    'target' => new \App\Models\Target,
    'url' => route('monitoring.target.create'),
    'icon' => 'fa-plus-square',
    'title' => __('Create :name', ['name' => __('menu.target')]),
    'submit_action' => route('monitoring.target.store'),
])
