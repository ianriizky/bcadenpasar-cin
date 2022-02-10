@include('monitoring.achievement.form', [
    'achievement' => $achievement,
    'url' => route('monitoring.achievement.edit', $achievement),
    'icon' => 'fa-edit',
    'title' => __('Edit :name', ['name' => __('menu.achievement')]),
    'submit_action' => route('monitoring.achievement.update', $achievement),
    'destroy_action' => route('monitoring.achievement.destroy', $achievement),
    'method' => 'PUT',
])
