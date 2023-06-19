<?php

namespace App\Http\Requests\StationOperator;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('station_operator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'license_plate'=>'required|unique:buses,license_plate',
            'model'=>'required|string',
            'capacity'=>'required|string',
            'owner_name'=>'nullable|string',

            //
        ];
    }
}
