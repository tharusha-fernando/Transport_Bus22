<?php

namespace App\Http\Requests\Reg_user;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('regular_user');
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'trip_id'=>'required|exists:trips,id',
            'user_id'=>'required|exists:users,id',
            'details'=>'required|string',
            'start'=>'required|exists:locations,id',
            'end'=>'required|exists:locations,id',
            'amount'=>'required|numeric',
            'seat_numbers'=>'required|string',
            'price'=>'required|numeric',

            
            //
        ];
    }
}
