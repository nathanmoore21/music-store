<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'label'];

    // protected $guarded = []; = if i wanted all my attributes set as mass assignable
    // protected $guarded = ['name']; = if i wanted name to be guarded


    //each music can have many artists
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
