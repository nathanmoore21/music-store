<?php

namespace App\Models;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'album', 'genre', 'rating', 'artist_id'];
    // protected $guarded = []; = if i wanted all my attributes set as mass assignable
    // protected $guarded = ['title']; = if i wanted title to be guarded

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
