<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
/**
 * @OA\Schema(
 *     schema="UpdateTaskRequest",
 *     title="Update Task Request",
 *     description="Request body for updating a task",
 *     @OA\Property(property="name", type="string", maxLength=255, nullable=true, example="Updated Task Name"),
 *     @OA\Property(property="description", type="string", nullable=true, example="Updated task description."),
 *     @OA\Property(property="due_date", type="string", format="date", nullable=true, example="2024-04-01"),
 *     @OA\Property(property="assigned_user_id", type="integer", nullable=true, example=3),
 *     @OA\Property(property="parent_task_id", type="integer", nullable=true, example=7)
 * )
 */
class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assigned_user_id' => 'nullable|exists:users,id',
            'parent_task_id' => [
                'nullable',
                'exists:tasks,id',
                Rule::notIn([$this->route('taskId')])
            ],
        ];
    }
}
