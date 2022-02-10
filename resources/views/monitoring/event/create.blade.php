@include('monitoring.event.form', [
    'event' => new \App\Models\Event,
    'url' => route('monitoring.event.create'),
    'icon' => 'fa-plus-square',
    'title' => __('Create :name', ['name' => __('menu.event')]),
    'submit_action' => route('monitoring.event.store'),
])
