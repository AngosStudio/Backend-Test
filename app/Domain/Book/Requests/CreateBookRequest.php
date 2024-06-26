<?php

namespace App\Domain\Book\Requests;

use App\Http\Requests\BaseRequest;

class CreateBookRequest extends BaseRequest
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
            'name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|numeric',
            'value' => 'required|numeric',
        ];

    }
}
