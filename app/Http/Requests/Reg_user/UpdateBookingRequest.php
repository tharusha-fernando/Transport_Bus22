<?php

namespace App\Http\Requests\Reg_user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('regular_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'trip_id'=>'sometimes|exists:trips,id',
            'user_id'=>'sometimes|exists:users,id',
            'details'=>'sometimes|string',
            'start'=>'sometimes|exists:locations,id',
            'end'=>'sometimes|exists:locations,id',
            'amount'=>'sometimes|numeric',
            'seat_numbers'=>'sometimes|string',
            'price'=>'sometimes|numeric',
            //
        ];
    }
}
