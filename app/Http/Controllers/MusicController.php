<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MusicResource;
use App\Http\Resources\MusicCollection;
use App\Http\Requests\StoreMusicRequest;

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
        // return new MusicCollection(Music::all());

        //eager loading
        //the code below, will get all music with artists (one to many) and genres (many to many)
        return new MusicCollection(Music::with('artist')
            ->with('genres')
            ->get());
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
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "album", "artist", "genre", "rating"},
     *            @OA\Property(property="title", type="string", format="string", example="Track Title"),
     *            @OA\Property(property="album", type="string", format="string", example="Album Title"),
     *            @OA\Property(property="artist", type="string", format="string", example="Name"),
     *            @OA\Property(property="rating", type="integer", format="integer", example="8"),
     *            @OA\Property(property="artist_id", type="integer", format="integer", example="10"),
     *            @OA\Property(property="genres", type="integer", format="integer", example="[1,2]")
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
    //store accept StoreMusicRequest and executes the validation rules
    public function store(StoreMusicRequest $request)
    //creates new music/songs
    {
        $music = Music::create([
            'title' => $request->title,
            'album' => $request->album,
            // 'genre' => $request->genre,
            'rating' => $request->rating,
            'artist_id' => $request->artist_id
        ]);

        //$music->genres() calls the belongsToMany function in the music model.
        $music->genres()->attach($request->genres);

        //calls for validation rules
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
     * Store a newly created song in storage.
     *
     * @OA\Put(
     *      path="/api/musics/{id}",
     *      operationId="put",
     *      tags={"Songs"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Music id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      summary="Update a song",
     *      description="Updates the song in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "album", "artist", "genre", "rating"},
     *            @OA\Property(property="title", type="string", format="string", example="Track Title"),
     *            @OA\Property(property="album", type="string", format="string", example="Album Title"),
     *            @OA\Property(property="rating", type="integer", format="integer", example="8"),
     *            @OA\Property(property="artist_id", type="integer", format="integer", example="10"),
     *            @OA\Property(property="genres", type="integer", format="integer", example="[1,2]")
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
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    //updates music/songs
    {
        $music->update($request->only([
            'title', 'album', 'rating', 'artist_id'
        ]));

        $music->genres()->attach($request->genres);

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
     *    description="Delete Music from the DB",
     *    security={{"bearerAuth":{}}},
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
