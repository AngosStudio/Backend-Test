<?php

namespace App\Domain\Book\Requests;

use App\Http\Requests\BaseRequest;

class UpdateBookRequest extends BaseRequest
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
            'name' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|unique:books,isbn,' . $this->route('book') . '|numeric',
            'value' => 'sometimes|numeric',
        ];

    }
}
