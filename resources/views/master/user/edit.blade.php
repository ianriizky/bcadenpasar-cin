@include('master.user.form', [
    'user' => $user,
    'url' => route('master.user.edit', $user),
    'icon' => 'fa-edit',
    'title' => __('Edit :name', ['name' => __('menu.user')]),
    'submit_action' => route('master.user.update', $user),
    'destroy_action' => route('master.user.destroy', $user),
    'method' => 'PUT',
])
