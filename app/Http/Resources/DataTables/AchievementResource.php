<?php

namespace App\Http\Resources\DataTables;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Achievement $resource
 */
class AchievementResource extends JsonResource
{
    /**
     * {@inheritDoc}
     */
    public function toArray($request)
    {
        $elements = [];

        if ($request->user()->can('view', $this->resource)) {
            $elements[] = view('components.datatables.link-show', [
                'url' => route('monitoring.achievement.show', $this->resource),
            ])->render();
        }

        if ($request->user()->can('update', $this->resource)) {
            $elements[] = view('components.datatables.link-edit', [
                'url' => route('monitoring.achievement.edit', $this->resource),
            ])->render();
        }

        if ($request->user()->can('delete', $this->resource)) {
            $elements[] = view('components.datatables.link-destroy', [
                'url' => route('monitoring.achievement.destroy', $this->resource),
            ])->render();
        }

        return [
            'checkbox' => view('components.datatables.checkbox', [
                'value' => $this->resource->getKey(),
            ])->render(),
            'branch_name' => view('components.datatables.link', [
                'url' => route('master.branch.show', $this->resource->target->branch),
                'name' => $this->resource->target->branch->name,
            ])->render(),
            'event_name' => view('components.datatables.link', [
                'url' => $this->resource->event ? route('monitoring.event.show', $this->resource->event->branch) : '#',
                'name' => $this->resource->event ? $this->resource->event->name : '-',
            ])->render(),
            'achieved_date' => $this->resource->achieved_date_iso_format,
            'achieved_by' => view('components.datatables.link', [
                'url' => $this->resource->achievedBy ? route('master.user.show', $this->resource->achievedBy) : '#',
                'name' => $this->resource->achievedBy ? $this->resource->achievedBy->name : '-',
            ])->render(),
            'amount' => $this->resource->getRawAttribute('amount'),
            'action' => view('components.datatables.button-group', compact('elements'))->render(),
        ];
    }
}
