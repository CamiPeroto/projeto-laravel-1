<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Alterar para TRUE sempre!
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
    }
    public function messages(): array
    {
        return[
            'course_id.required' => 'É necessário enviar o ID do curso!',
            'name.required' => 'O campo nome é obrigatório!',
            'description.required' => 'O campo descrição é obrigatório!',
        ];
    }
}
