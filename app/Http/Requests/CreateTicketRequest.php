<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'subject'               => 'required',
            'details'               => 'required',
            'assigned_to'           => 'required',
            'priority'              => 'required',

            ];
    }

    public function messages(): array{
        return[

            'subject.required'         => 'El ticket necesita tener un asunto',
            'details.required'         => 'El ticket debe tener un contenido/detalles/descripcion', 
            'assigned_to.required'     => 'El ticket debe estar asignado a alguien por su ID',
            'priority'                 => 'Es necesario asignar el nivel de prioridad del ticket / valor numerico'

            ];
    }
}
