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
        $genres = array();
        foreach ($this->genres as $genre) {
            array_push($genres, $genre->genre);
        }

        //removed 'artist' as it is no longer needed as I have 'artist_id' (one to many)
        //removed 'genre' as it is no longer needed as I have 'genres' (many to many)
        return [
            'id' => $this->id,
            'title' => $this->title,
            'album' => $this->album,
            // 'artist' => $this->artist,
            // 'genre' => $this->genre,
            'rating' => $this->rating,
            'artist_id' => $this->artist->id,
            'artist_name' => $this->artist->name,
            'artist_label' => $this->artist->label,
            'genres' => $genres
        ];
    }
}
