<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //authorize set to true will require authorisation for updating artists
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
        $method = $this->method();

        //both attributes are required for PUT method, unlike PATCH which only sometimes requires them
        if ($method == 'PUT') {
            return [
                'name' => ['required'],
                'label' => ['required']
            ];
        }
        //else PATCH
        else {
            return [
                'name' => ['sometimes', 'required'],
                'label' => ['sometimes', 'required']
            ];
        }
    }
}
