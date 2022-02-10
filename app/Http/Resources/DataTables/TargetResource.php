<?php

namespace App\Http\Resources\DataTables;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Target $resource
 */
class TargetResource extends JsonResource
{
    /**
     * {@inheritDoc}
     */
    public function toArray($request)
    {
        $elements = [];

        if ($request->user()->can('view', $this->resource)) {
            $elements[] = view('components.datatables.link-show', [
                'url' => route('monitoring.target.show', $this->resource),
            ])->render();
        }

        if ($request->user()->can('update', $this->resource)) {
            $elements[] = view('components.datatables.link-edit', [
                'url' => route('monitoring.target.edit', $this->resource),
            ])->render();
        }

        if ($request->user()->can('delete', $this->resource)) {
            $elements[] = view('components.datatables.link-destroy', [
                'url' => route('monitoring.target.destroy', $this->resource),
            ])->render();
        }

        return [
            'checkbox' => view('components.datatables.checkbox', [
                'value' => $this->resource->getKey(),
            ])->render(),
            'branch_name' => view('components.datatables.link', [
                'url' => route('master.branch.show', $this->resource->branch),
                'name' => $this->resource->branch->name,
            ])->render(),
            'periodicity' => $this->resource->periodicity->label,
            'start_date' => $this->resource->start_date_iso_format,
            'end_date' => $this->resource->end_date_iso_format,
            'amount' => $this->resource->getRawAttribute('amount'),
            'action' => view('components.datatables.button-group', compact('elements'))->render(),
        ];
    }
}
