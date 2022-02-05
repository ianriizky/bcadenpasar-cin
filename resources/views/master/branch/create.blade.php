@include('master.branch.form', [
    'branch' => new \App\Models\Branch,
    'url' => route('master.branch.create'),
    'icon' => 'fa-plus-square',
    'title' => __('Create :name', ['name' => __('menu.branch')]),
    'submit_action' => route('master.branch.store'),
])
