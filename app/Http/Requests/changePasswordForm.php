<?php

namespace App\Http\Requests;

use App\Rules\checkOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class changePasswordForm extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ancienmdp'=>['required',new checkOldPassword],
            'nouveaumdp'=>'required|confirmed',
            'nouveaumdp_confirmation'=>'required',
        ];
    }
    public function messages():array
    {
        return [
            'ancienmdp.required'=> 'L\'ancien mot de passe est requis',
            'nouveaumdp.required'=>'Le nouveau mot de passe est requis',
            'nouveaumdp.confirmed'=>'Les deux mots de passe ne correspondent pas.',
            'nouveaumdp_confirmation.required'=>'Veuillez entrez de nouveau le mot de passe.',
        ];
    }
}
