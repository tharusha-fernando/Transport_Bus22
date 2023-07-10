<?php

namespace App\Http\Requests\Reg_user;

use Illuminate\Foundation\Http\FormRequest;

class GetBookingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->check() && auth()->user()->hasRole('regular_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
