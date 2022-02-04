<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\DataTables\BranchResource;
use App\Models\Branch;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Branch::class, 'branch');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('master.branch.index');
    }

    /**
     * Return datatable server side response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        $this->authorize('viewAny', Branch::class);

        return DataTables::eloquent(Branch::query())
            ->setTransformer(fn ($model) => BranchResource::make($model)->resolve())
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
        return view('master.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Branch\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        /** @var \App\Models\Branch $branch */
        $branch = Branch::make($request->validated())->setBranchRelationValue(
            $request->getBranch()
        );

        $branch->save();

        $branch->syncRoles($request->input('role'));

        Event::dispatch(new Registered($branch));

        return redirect()->route('master.branch.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was created!', ['resource' => trans('menu.branch')]),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Branch $branch)
    {
        return view('master.branch.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Branch $branch)
    {
        $branch->append('role');

        return view('master.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Branch\UpdateRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Branch $branch)
    {
        $branch = $branch->fill($request->validated())->setBranchRelationValue(
            $request->getBranch()
        );

        $branch->save();

        $branch->syncRoles($request->input('role'));

        return redirect()->route('master.branch.edit', $branch)->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was updated!', ['resource' => trans('menu.branch')]),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('master.branch.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.branch')]),
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
                $branch = Branch::find($id, 'id');

                $this->authorize('delete', $branch);

                $branch->delete();
            }
        });

        return redirect()->route('master.branch.index')->with([
            'alert' => [
                'type' => 'alert-success',
                'message' => trans('The :resource was deleted!', ['resource' => trans('menu.branch')]),
            ],
        ]);
    }
}
