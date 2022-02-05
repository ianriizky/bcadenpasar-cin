@include('master.branch.form', [
    'branch' => $branch,
    'url' => route('master.branch.edit', $branch),
    'icon' => 'fa-edit',
    'title' => __('Edit :name', ['name' => __('menu.branch')]),
    'submit_action' => route('master.branch.update', $branch),
    'destroy_action' => route('master.branch.destroy', $branch),
    'method' => 'PUT',
])
