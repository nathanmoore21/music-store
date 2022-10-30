<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'album', 'artist', 'genre', 'rating'];
    // protected $guarded = []; = if i wanted all my attributes set as mass assignable
    // protected $guarded = ['title']; = if i wanted title to be guarded
}
