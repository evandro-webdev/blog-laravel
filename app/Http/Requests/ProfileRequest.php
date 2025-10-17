<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:20', Rule::unique('users')->ignore(Auth::id()), function($attribute, $value, $fail){
          $this->validateReservedUsername($value, $fail);
        }],
        'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
        'bio' => ['nullable', 'string', 'max:500'],
        'city' => ['nullable', 'string', 'max:85'],
        
        'twitter' => ['nullable', 'url', 'max:255'],
        'github' => ['nullable', 'url', 'max:255'],
        'instagram' => ['nullable', 'url', 'max:255'],
        'linkedin' => ['nullable', 'url', 'max:255'],
        'youtube' => ['nullable', 'url', 'max:255'],
      ];
    }

    protected function validateReservedUsername($value, $fail){
      $reserved = config('reserved.usernames'); 

      if (in_array(strtolower($value), $reserved)) { 
        $fail('Esse nome de usuário é reservado.'); 
      }
    }
}
