<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'judul_buku'		=> 'required',
            'sampul_buku'		=> 'required_if:file_exist,false|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'daftarisi_buku'	=> 'required_if:file_exist,false|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
