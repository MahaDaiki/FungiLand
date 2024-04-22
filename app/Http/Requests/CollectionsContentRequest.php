<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionsContentRequest extends FormRequest
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
            'collection_id' => 'required|exists:collections,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'media' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:20480',
        ];
    }
}
