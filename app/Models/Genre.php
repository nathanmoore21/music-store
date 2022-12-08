<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['genre'];
    // protected $guarded = []; = if i wanted all my attributes set as mass assignable (in this instance, just the one)
    // protected $guarded = ['genre']; = if i wanted genre to be guarded (if there were more attributes)

    //added the ‘belongsToMany’ relationship below as the genre model belongs to many musics(songs).
    public function musics()
    {
        return $this->belongstoMany(Music::class)->withTimestamps();
    }
}
