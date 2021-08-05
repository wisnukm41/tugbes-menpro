<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:500',
            'bumpprice' => 'nullable|gt:price',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Produk Harus Diisi',
            'name.max' => 'Nama Produk Maksimal 255 Karakter',
            'price.required' => 'Harga Produk Harus Diisi',
            'price.min' => 'Harga Produk Minimal Rp.500',
            'stock.required' => 'Stok Produk Harus Diisi',
            'weight.required' => 'BeratP Produk Harus Diisi',
            'description.required' => 'Deskripsi Produk Harus Diisi',
            'bumpprice.gt' => 'Harga Iklan Harus lebih Tinggi dari Harga Produk'
        ];
    }
}
