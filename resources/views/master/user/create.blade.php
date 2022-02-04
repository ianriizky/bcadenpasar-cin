@include('master.user.form', [
    'user' => new \App\Models\User,
    'url' => route('master.user.create'),
    'icon' => 'fa-plus-square',
    'title' => __('Create :name', ['name' => __('menu.user')]),
    'submit_action' => route('master.user.store'),
])
