<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         $user = Auth::user();
        // se l'email é quello scelto può accedere alle funzioni.
              if ($user->email === "valerio@email.it") {
        // se ritorno true l'operazione viene permessa
              return true;
         } else
        return false; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                
            "title" => "required|max:55",
            "url_link" => "required",
            "publication_date"=>"required",
            "description"=>"nullable",
            "image" => "nullable|image|max:6144",
            "type_id"=>"nullable|exists:types,id",
            "tecnologies"=>"nullable"
        ];
    }
}
