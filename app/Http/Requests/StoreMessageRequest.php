<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
    
    protected function prepareForValidation()
    {
        // return array_merge($this->all(), [
        //     'user_id' => auth()->user()->id,
        // ]);
        // ass
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
            'message'=>'required|string',
            'status'=>'nullable',
            'attachment'=>'nullable',
            'thread_id'=>'required|exists:threads,id',
            'user_id'=>'required|exists:users,id'
            //
        ];
    }
}
