<?php

namespace App\Http\Controllers;

use App\Http\Requests\Target\StoreRequest;
use App\Http\Requests\Target\UpdateRequest;
use App\Http\Resources\DataTables\TargetResource;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TargetController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Target::class, 'target');
    }

    /**
     * Display index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('monitoring.target.index');
    }

    /**
     * Return datatable server side response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        $this->authorize('viewAny', Target::class);

        return DataTables::eloquent(Target::query())
            ->setTransformer(fn ($model) => TargetResource::make($model)->resolve())
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('monitoring.target.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Target\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $request->store();

        return redirect()->route('monitoring.target.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was created!', ['resource' => trans('menu.target')]),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Target $target)
    {
        return view('monitoring.target.show', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Target $target)
    {
        return view('monitoring.target.edit', compact('target'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Target\UpdateRequest  $request
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Target $target)
    {
        $target = $request->update($target);

        return redirect()->route('monitoring.target.edit', $target)->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was updated!', ['resource' => trans('menu.target')]),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Target $target)
    {
        $target->delete();

        return redirect()->route('monitoring.target.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.target')]),
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
                $target = Target::find($id, 'id');

                $this->authorize('delete', $target);

                $target->delete();
            }
        });

        return redirect()->route('monitoring.target.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.target')]),
            ],
        ]);
    }
}
