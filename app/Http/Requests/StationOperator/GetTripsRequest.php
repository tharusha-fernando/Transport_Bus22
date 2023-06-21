<?php

namespace App\Http\Requests\StationOperator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTripsRequest extends FormRequest
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
            'search' => 'nullable|string',
            'search_by' => ['nullable','array'],
            'order_by' => ['nullable', Rule::in(['asc', 'desc'])],
            'day' => ['nullable', Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])],
            'search_busid' => 'nullable|exists:buses,id',
            'search_start' => 'nullable|date_format:H:i:s',
            'search_end' => 'nullable|date_format:H:i:s',
            'search_route_id' => 'nullable|exists:routes,id',
            'search_status' => 'nullable|string',
            'search_to' => 'nullable|exists:bus_stations,id',
            'search_from' => 'nullable|exists:bus_stations,id',

            //
        ];
    }

    public function messages()
    {
        return [
            
            'order_by' => 'order by only can be asc or desc',
            'day' => 'day  only can be Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday'
        ];
    }
}
