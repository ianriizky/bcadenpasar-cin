@include('monitoring.event.form', [
    'event' => $event,
    'url' => route('monitoring.event.edit', $event),
    'icon' => 'fa-edit',
    'title' => __('Edit :name', ['name' => __('menu.event')]),
    'submit_action' => route('monitoring.event.update', $event),
    'destroy_action' => route('monitoring.event.destroy', $event),
    'method' => 'PUT',
])
