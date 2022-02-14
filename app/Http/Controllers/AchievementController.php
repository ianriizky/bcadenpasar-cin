<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataTables\AchievementResource;
use App\Models\Achievement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AchievementController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Achievement::class, 'achievement');
    }

    /**
     * Display index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('monitoring.achievement.index');
    }

    /**
     * Return datatable server side response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $this->authorize('viewAny', Achievement::class);

        $query = Achievement::query()
            ->join('targets', 'achievements.target_id', '=', 'targets.id')
            ->join('branches', 'targets.branch_id', '=', 'branches.id')
            ->leftJoin('events', 'achievements.event_id', '=', 'events.id')
            ->leftJoin('users', 'achievements.achieved_by', '=', 'users.id')
            ->when($request->user()->isManager() || $request->user()->isStaff(), function (Builder $query) use ($request) {
                $query->where('branches.id', $request->user()->branch->getKey());
            })->select(
                'achievements.*',
                'branches.id as branch_id', 'branches.name as branch_name',
                'events.id as event_id', 'events.name as event_name',
                'users.id as achieved_by_id', 'users.name as achieved_by_name'
            );

        return DataTables::eloquent($query)
            ->setTransformer(fn ($model) => AchievementResource::make($model)->resolve())
            ->orderColumn('branch_name', function ($query, $direction) {
                $query->orderBy('branches.name', $direction);
            })->filterColumn('branch_name', function ($query, $keyword) {
                $query->where('branches.name', 'like', '%' . $keyword . '%');
            })->orderColumn('event_name', function ($query, $direction) {
                $query->orderBy('events.name', $direction);
            })->filterColumn('event_name', function ($query, $keyword) {
                $query->where('events.name', 'like', '%' . $keyword . '%');
            })->orderColumn('achieved_by_name', function ($query, $direction) {
                $query->orderBy('users.name', $direction);
            })->filterColumn('achieved_by_name', function ($query, $keyword) {
                $query->where('users.name', 'like', '%' . $keyword . '%');
            })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('monitoring.achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Achievement\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $request->store();

        return redirect()->route('monitoring.achievement.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was created!', ['resource' => trans('menu.achievement')]),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Achievement $achievement)
    {
        return view('monitoring.achievement.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Achievement $achievement)
    {
        return view('monitoring.achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Achievement\UpdateRequest  $request
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Achievement $achievement)
    {
        $achievement = $request->update($achievement);

        return redirect()->route('monitoring.achievement.edit', $achievement)->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was updated!', ['resource' => trans('menu.achievement')]),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        return redirect()->route('monitoring.achievement.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.achievement')]),
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
                $achievement = Achievement::find($id, 'id');

                $this->authorize('delete', $achievement);

                $achievement->delete();
            }
        });

        return redirect()->route('monitoring.achievement.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.achievement')]),
            ],
        ]);
    }
}
