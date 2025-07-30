<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCrewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20|unique:crews,phone_number',
            'nationality'   => 'required|string|max:100',
            'ship_id'       => 'required|exists:ships,id',
            'role'          => 'required|in:Captain,Engineer,Deckhand,Cook',
            'is_active'     => 'required|boolean',
          
        ];
    }
}
