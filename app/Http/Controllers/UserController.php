<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\DataTables\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('master.user.index');
    }

    /**
     * Return datatable server side response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $query = User::query()
            ->join('branches', 'users.branch_id', '=', 'branches.id')
            ->when($request->user()->isManager() || $request->user()->isStaff(), function (Builder $query) use ($request) {
                $query->where('branches.id', $request->user()->branch->getKey());
            })
            ->select('users.*', 'branches.name as branch_name');

        return DataTables::eloquent($query)
            ->setTransformer(fn ($model) => UserResource::make($model)->resolve())
            ->orderColumn('branch_name', function ($query, $direction) {
                $query->orderBy('branches.name', $direction);
            })->filterColumn('branch_name', function ($query, $keyword) {
                $query->where('branches.name', 'like', '%' . $keyword . '%');
            })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $user = $request->store()->syncRoles($request->input('role'));

        Event::dispatch(new Registered($user));

        return redirect()->route('master.user.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was created!', ['resource' => trans('menu.user')]),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        return view('master.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(User $user)
    {
        $user->append('role');

        return view('master.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user = $request->update($user)->syncRoles($request->input('role'));

        return redirect()->route('master.user.edit', $user)->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was updated!', ['resource' => trans('menu.user')]),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('master.user.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.user')]),
            ],
        ]);
    }

    /**
     * Remove the specified list of resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMultiple(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->input('checkbox', []) as $id) {
                $user = User::find($id, 'id');

                $this->authorize('delete', $user);

                $user->delete();
            }
        });

        return redirect()->route('master.user.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.user')]),
            ],
        ]);
    }
}
