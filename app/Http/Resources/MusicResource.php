<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    //will call the database and return the folling
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'album' => $this->album,
            // 'artist' => $this->artist,
            'genre' => $this->genre,
            'rating' => $this->rating,
            'artist_id' => $this->artist->id,
            'artist_name' => $this->artist->name,
            'artist_label' => $this->artist->label
        ];
    }
}
