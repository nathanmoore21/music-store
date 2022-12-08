<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;
    //removed 'artist' and replaced it with 'artist_id' as it is now set as a foreign key
    protected $fillable = ['title', 'album', 'genre', 'rating', 'artist_id'];
    // protected $guarded = []; = if i wanted all my attributes set as mass assignable
    // protected $guarded = ['title']; = if i wanted title to be guarded


    //added the ‘belongsTo’ relationship below so the music model belongs to artist.
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    //added the ‘belongsToMany’ relationship below as the music model belongs to many genres.
    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }
}
