<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      $user = Auth::user();
      if($user->role == 2 || $user->role == 0){
        return true;
      }else {
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
         $photos = count($this->input('photos'));
         foreach(range(0, $photos) as $index) {
             $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
         }
         return $rules;
      }

}
