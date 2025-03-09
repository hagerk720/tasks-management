<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateTaskStatusRequest",
 *     title="Update Task Status Request",
 *     description="Request body for updating a task's status",
 *     required={"status_id"},
 *     @OA\Property(
 *         property="status_id",
 *         type="integer",
 *         example=2,
 *         description="The ID of the new status"
 *     )
 * )
 */
class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status_id' => 'required|exists:statuses,id',
        ];
    }
}
