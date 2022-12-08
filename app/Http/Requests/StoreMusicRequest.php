<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMusicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //authorize set to true will require authorisation for storing music
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
            'title' => ['required'],
            'album' => ['required'],
            // 'genre' => ['required'],
            'rating' => ['required'],
            'artist_id' => ['required'],
            //genres is an array coming in from the request. Laravel will check to see if genre exists
            'genres' => ['required', 'exists:genres,id']
        ];
    }
}
