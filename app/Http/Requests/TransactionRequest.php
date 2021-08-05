<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'contact.required' => 'Contact Field is Required',
            'address.required' => 'Address Field is Required',
        ];
    }
}
