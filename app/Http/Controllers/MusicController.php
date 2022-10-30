<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicCollection;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

//Music Contoller page to display the Get, Update and Delete methods on Swagger

///////////////////////////////////////////////////////////////////

class MusicController extends Controller
{
    /**
     * Display a listing of the songs.
     *
     * @OA\Get(
     *     path="/api/musics",
     *     description="Displays all the songs",
     *     tags={"Songs"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of songs in JSON format"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    //Gets all music/songs
    {
        return new MusicCollection(Music::all());
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Store a newly created song in storage.
     *
     * @OA\Post(
     *      path="/api/musics",
     *      operationId="store",
     *      tags={"Songs"},
     *      summary="Create a new song",
     *      description="Stores the song in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "album", "artist", "genre", "rating"},
     *            @OA\Property(property="title", type="string", format="string", example="Track Title"),
     *            @OA\Property(property="album", type="string", format="string", example="Album Title"),
     *            @OA\Property(property="artist", type="string", format="string", example="Artist's Name"),
     *            @OA\Property(property="genre", type="string", format="string", example="Pop, Rock, Indie etc.."),
     *            @OA\Property(property="rating", type="integer", format="integer", example="1-10")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\MusicResource
     */
    public function store(Request $request)
    //creates new music/songs
    {
        $music = Music::create($request->only([
            'title', 'album', 'artist', 'genre', 'rating'
        ]));
        return new MusicResource($music);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Display a song by it's {id}.
     * @OA\Get(
     *     path="/api/musics/{id}",
     *     description="Gets a song by ID",
     *     tags={"Songs"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Music id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\MusicResource
     */
    public function show(Music $music)
    //gets music/song by {id}
    {
        return new MusicResource($music);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Update a song in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    //updates music/songs
    {
        $music->update($request->only([
            'title', 'album', 'artist', 'genre', 'rating'
        ]));

        return new MusicResource($music);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/musics/{id}",
     *    operationId="destroy",
     *    tags={"Songs"},
     *    summary="Delete Music",
     *    description="Delete Music",
     *    @OA\Parameter(name="id", in="path", description="Id of a song", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */

    public function destroy(Music $music)
    //delets music/songs
    {
        $music->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

///////////////////////////////////////////////////////////////////
