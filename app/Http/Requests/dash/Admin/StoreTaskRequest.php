<?php

namespace App\Http\Requests\dash\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
           "title"=> 'required|string|between:3,50|unique:tasks,title',
           "description"=> 'required|string|between:3,500',
           "adminNameId"=>  'required|exists:users,id',
           "assignedNameId"=> 'required|exists:users,id',
        ];
    }
}
