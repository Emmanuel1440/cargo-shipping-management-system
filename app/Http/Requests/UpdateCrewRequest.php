<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCrewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('crews', 'phone_number')->ignore($this->crew),
            ],
            'nationality' => 'required|string|max:100',
            'ship_id' => 'required|exists:ships,id',
            'role' => 'required|in:Captain,Engineer,Deckhand,Cook',
            'is_active' => 'required|boolean',
            
        ];
    }
}
