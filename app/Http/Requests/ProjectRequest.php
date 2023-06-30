<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=> 'required|min:5|max:255',
            'description'=> 'required|min:20',

        ];
    }

    public function messages()
    {
        return[
            'title.required'=> 'Il titolo è un campo obbligatorio',
            'title.min'=> 'Il titolo deve avere più di 5 caratteri',
            'title.max'=> 'Il titolo può evere massimo 255 caratteri',
            'description.required'=> 'La descrizione è un campo obbligatorio',
            'description.min'=> 'La descrizione è troppo breve',
        ];
    }
}
