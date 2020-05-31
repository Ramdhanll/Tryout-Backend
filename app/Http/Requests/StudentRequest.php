<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
          'data.nisn' => 'required|numeric',
          'data.gender' => 'required',
          'data.date_of_birth' => 'required',
          'data.address' => 'required',
          'data.expertise_program' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'data.nisn.required' => 'Field NISN masih kosong.',
          'data.nisn.numeric' => 'Field NISN harus berupa angka.',
          'data.gender.required' => 'Field gender masih kosong.',
          'data.date_of_birth.required' => 'Field tanggal lahir masih kosong.',
          'data.address.required' => 'Field address masih kosong.',
          'data.expertise_program.required' => 'Field expertise_program masih kosong.',
        ];
    }


}
