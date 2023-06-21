<?php

namespace App\Http\Requests\StationOperator;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('station_operator');
    }

    protected function prepareForValidation()
    {
        $busStation = $this->user()->BusStation()->first();
        $this->merge([
            'bus_station_id' => $busStation->id,
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
            'time_table_id'=>'required|exists:time_tables,id',
            'bus_id'=>'required|exists:buses,id',
            'type'=>'required|string',
            'details'=>'required|string',
            'location_id'=>'required|exists:locations,id',
            'start'=>'required|date_format:H:i:s',
            'end'=>'required|date_format:H:i:s',
            'route_id'=>'required|exists:routes,id',
            'distance'=>'required|numeric',
            'status'=>'required|string',
            'from'=>'required|exists:bus_stations,id',
            'to'=>'required|exists:bus_stations,id',

            //
        ];
    }
}
