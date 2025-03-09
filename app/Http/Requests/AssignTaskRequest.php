<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="AssignTaskRequest",
 *     title="Assign Task Request",
 *     description="Request body for assigning a task",
 *     required={"assigned_user_id"},
 *     @OA\Property(property="assigned_user_id", type="integer", example=3, description="The ID of the user to whom the task is assigned")
 * )
 */
class AssignTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'assigned_user_id' => 'required|exists:users,id',
        ];
    }
}
