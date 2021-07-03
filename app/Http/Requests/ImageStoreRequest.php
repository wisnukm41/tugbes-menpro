<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageStoreRequest extends FormRequest
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
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'image.*.image' => 'Jenis File Harus Gambar',
            'image.*.max' => 'Jumlah File Maximum 6',
        ];
    }
}
