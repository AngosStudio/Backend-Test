<?php

namespace App\Domain\BookStore\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class AddBookRequest extends BaseRequest
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
            'book_id' => [
                'required',
                'exists:books,id',
                Rule::unique('book_store')->where(function ($query) {
                    return $query
                        ->where('book_id', $this->book_id)
                        ->where('store_id', $this->store_id)
                    ;
                }),
            ],
            'store_id' => [
                'required',
                'exists:stores,id',
            ],
        ];
    }
}
