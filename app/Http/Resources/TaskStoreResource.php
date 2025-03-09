<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => $this->status->name,
            'assigned_user' => $this->assignedUser ? [
                'id' => $this->assigned_user_id,
                'name' => $this->assignedUser->name
            ] : null,
            'created_by' => [
                'id' => $this->creator->id,
                'name' => $this->creator->name
            ],
            'parent_task' => $this->parentTask ? [
                'id' => $this->parent_task_id,
                'name' => $this->parentTask->name
            ] : null,
        ];
    }
}
