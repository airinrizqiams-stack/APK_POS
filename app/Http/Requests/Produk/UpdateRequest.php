<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_id'   => 'required|exists:jenis,id',
            'nama'       => 'required|string|max:255',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok'       => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_id.required'   => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'     => 'Jenis produk tidak valid.',
            'nama.required'       => 'Nama produk wajib diisi.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'stok.required'       => 'Stok wajib diisi.',
            'foto.image'          => 'File yang diupload harus gambar.',
            'foto.mimes'          => 'Ekstensi gambar harus JPG, JPEG, PNG.',
            'foto.max'            => 'Maksimal ukuran gambar 2MB.',
        ];
    }
}