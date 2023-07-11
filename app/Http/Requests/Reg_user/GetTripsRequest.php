<?php

namespace App\Http\Requests\Reg_user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTripsRequest extends FormRequest
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

            'search_start' => 'nullable|date_format:H:i:s',
            'route' => 'nullable|string',
            'status' => ['nullable',Rule::in(['pending', 'in progress','completed','asasasasassasasasasaaaas','scheduled'])],            
                        //
        ];
    }

    public function messages()
    {
        return [
            
            // 'order_by' => 'order by only can be asc or desc',
            'route' => 'day  only can be pending, in progress, completed, asasasasassasasasasaaaas, scheduled, Saturday, Sunday'
        ];
    }
}
