<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OmoideRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
       return false;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
       return [
           'content' => 'required|max:255',
           'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
       ];
   }
}