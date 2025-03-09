<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="TaskResource",
 *     title="Task Resource",
 *     description="Task details",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Fix Bug #123"),
 *     @OA\Property(property="description", type="string", example="Resolve API authentication issue"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2024-03-15"),
 *     @OA\Property(property="status_id", type="integer", example=2),
 *     @OA\Property(property="assigned_user_id", type="integer", example=5),
 *     @OA\Property(property="dependencies", type="array", @OA\Items(ref="#/components/schemas/TaskResource"))
 * )
 */
class TaskResource extends JsonResource
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
            'status_id' => $this->status_id,
            'assigned_user' => $this->assignedUser ? [
                'id' => $this->assignedUser->id,
                'name' => $this->assignedUser->name
            ] : null,
            'created_by' => $this->creator ? [
                'id' => $this->creator->id,
                'name' => $this->creator->name
            ] : null,
            'dependencies' => TaskResource::collection($this->dependencies),
        ];
    }
}
