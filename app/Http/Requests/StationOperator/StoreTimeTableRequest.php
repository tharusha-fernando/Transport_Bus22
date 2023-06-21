<?php

namespace App\Http\Requests\StationOperator;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeTableRequest extends FormRequest
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
            'name'=>'required|string',
            'description'=>'required|string',
            'bus_station_id'=>'required|exists:bus_stations,id',
            //
        ];
    }
}
