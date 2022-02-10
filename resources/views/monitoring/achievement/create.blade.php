@include('monitoring.achievement.form', [
    'achievement' => new \App\Models\Achievement,
    'url' => route('monitoring.achievement.create'),
    'icon' => 'fa-plus-square',
    'title' => __('Create :name', ['name' => __('menu.achievement')]),
    'submit_action' => route('monitoring.achievement.store'),
])
