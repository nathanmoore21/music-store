<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicCollection;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MusicCollection(Music::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $music = Music::create($request->only([
            'title', 'album', 'artist', 'genre', 'rating'
        ]));
        return new MusicResource($music);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\MusicResource
     */
    public function show(Music $music)
    {
        return new MusicResource($music);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
        $music->update($request->only([
            'title', 'album', 'artist', 'genre', 'rating'
        ]));

        return new MusicResource($music);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        //
    }
}
