<?php

namespace App\Http\Resources\DataTables;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Event $resource
 */
class EventResource extends JsonResource
{
    /**
     * {@inheritDoc}
     */
    public function toArray($request)
    {
        $elements = [];

        if ($request->user()->can('view', $this->resource)) {
            $elements[] = view('components.datatables.link-show', [
                'url' => route('monitoring.event.show', $this->resource),
            ])->render();
        }

        if ($request->user()->can('update', $this->resource)) {
            $elements[] = view('components.datatables.link-edit', [
                'url' => route('monitoring.event.edit', $this->resource),
            ])->render();
        }

        if ($request->user()->can('delete', $this->resource)) {
            $elements[] = view('components.datatables.link-destroy', [
                'url' => route('monitoring.event.destroy', $this->resource),
            ])->render();
        }

        return [
            'checkbox' => view('components.datatables.checkbox', [
                'value' => $this->resource->getKey(),
            ])->render(),
            'branch_name' => view('components.datatables.link', [
                'url' => route('master.branch.show', $this->resource->branch_id),
                'name' => $this->resource->branch_name,
            ])->render(),
            'name' => $this->resource->name,
            'date' => $this->resource->date_iso_format,
            'location' => $this->resource->location,
            'action' => view('components.datatables.button-group', compact('elements'))->render(),
        ];
    }
}
