<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetDriversRequest extends FormRequest
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
            'search'=>'nullable|string',
            'search_by'=>Rule::in(['nic','name']),
            'order_by'=>Rule::in(['asc','desc'])
            //
        ];
    }

    public function messages()
    {
        return[  
        'search_by'=>'search by only can be nic or name',
        'order_by'=>'order by only can be asc or desc'
        ];
    }
}
