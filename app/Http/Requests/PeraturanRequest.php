<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeraturanRequest extends FormRequest
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
            'id_peraturan'	=> 'required',
            // 'id_katalog'	=> 'required',
            'nomor_dokumen'	=> 'required',
            'tahun_dokumen'	=> 'required|numeric',
            'file_dokumen'	=> 'required_if:file_exist,false|max:50000|mimes:pdf',
        ];
    }
}
