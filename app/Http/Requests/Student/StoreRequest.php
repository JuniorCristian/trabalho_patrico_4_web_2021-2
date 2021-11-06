<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->level == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:App\Models\Student,name|unique:App\Models\User,name',
            'email'=>'required|unique:App\Models\User,email|email',
            'entry_date'=>'required|date',
            'born_date'=>'required|date',
            'course_id'=>'required|exists:App\Models\Course,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.unique' => 'O nome informado ja existe',
            'email.email' => 'O email não é válido',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'O email informado ja existe',
            'entry_date.required' => 'O campo data de entrada é obrigatório',
            'entry_date.date' => 'A data informada não é válida',
            'born_date.required' => 'O campo data de nascimento é obrigatório',
            'born_date.date' => 'A data informada não é válida',
            'course_id.required' => 'O campo curso é obrigatório',
            'course_id.exists' => 'O curso selecionado não existe'
        ];
    }
}
