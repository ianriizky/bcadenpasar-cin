<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\DataTables\EventResource;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('monitoring.event.index');
    }

    /**
     * Return datatable server side response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $this->authorize('viewAny', Event::class);

        $query = Event::query()
            ->join('branches', 'events.branch_id', '=', 'branches.id')
            ->when($request->user()->isManager() || $request->user()->isStaff(), function (Builder $query) use ($request) {
                $query->where('branches.id', $request->user()->branch->getKey());
            })
            ->select('events.*', 'branches.name as branch_name');

        return DataTables::eloquent($query)
            ->setTransformer(fn ($model) => EventResource::make($model)->resolve())
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
        return view('monitoring.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Event\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $request->store();

        return redirect()->route('monitoring.event.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was created!', ['resource' => trans('menu.event')]),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Event $event)
    {
        return view('monitoring.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Event $event)
    {
        return view('monitoring.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Event\UpdateRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $event = $request->update($event);

        return redirect()->route('monitoring.event.edit', $event)->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was updated!', ['resource' => trans('menu.event')]),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('monitoring.event.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.event')]),
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
                $event = Event::find($id, ['id', 'branch_id']);

                $this->authorize('delete', $event);

                $event->delete();
            }
        });

        return redirect()->route('monitoring.event.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.event')]),
            ],
        ]);
    }
}
