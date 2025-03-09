<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="StoreTaskRequest",
 *     title="Store Task Request",
 *     description="Request body for creating a task",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="New Task"),
 *     @OA\Property(property="description", type="string", nullable=true, example="This is a sample task description."),
 *     @OA\Property(property="due_date", type="string", format="date", nullable=true, example="2024-03-15"),
 *     @OA\Property(property="assigned_user_id", type="integer", nullable=true, example=2),
 *     @OA\Property(property="parent_task_id", type="integer", nullable=true, example=5)
 * )
 */
class StoreTaskRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assigned_user_id' => 'nullable|exists:users,id',
            'parent_task_id' => 'nullable|exists:tasks,id',
        ];
    }
}
