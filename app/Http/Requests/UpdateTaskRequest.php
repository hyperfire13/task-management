<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'users_id' => 'required|numeric',
            'title' => 'required|max:100|unique:tasks,title,'.$this->task->id,
            'description' => 'required',
            'fileImg' => 'image|mimes:jpeg,png,jpg,gif|max:4000',
        ];
    }
}
