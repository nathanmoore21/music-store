<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicCollection;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/musics",
     *     description="Displays all the songs",
     *     tags={"Musics"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Songs in JSON format"
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
    {
        // $books = Book::all();
        // return new BookCollection($books);
        return new MusicCollection(Music::all());
    }

    //////////

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/musics",
     *      operationId="store",
     *      tags={"Musics"},
     *      summary="Create a new Song",
     *      description="Stores the song in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "album", "artist", "genre", "rating"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="album", type="string", format="string", example="Autobiography"),
     *            @OA\Property(property="artist", type="string", format="string", example="A long description about this great book"),
     *            @OA\Property(property="genre", type="string", format="string", example="Me"),
     *             @OA\Property(property="rating", type="integer", format="integer", example="1")
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
    {

        $music = Music::create($request->only([
            'title', 'album', 'artist', 'genre', 'rating'
        ]));

        return new MusicResource($music);
    }



    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/api/musics/{id}",
     *     description="Gets a music by ID",
     *     tags={"Musics"},
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\BookResource
     */
    public function show(Music $music)
    {
        return new MusicResource($music);
    }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Music  $music
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Music $music)
    // {
    //     $music->update($request->only([
    //         'title', 'album', 'artist', 'genre', 'rating'
    //     ]));

    //     return new MusicResource($music);
    // }

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

    //     /**
    //      * Remove the specified resource from storage.
    //      *
    //      * @param  \App\Models\Music  $music
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function destroy(Music $music)
    //     {
    //         $music->delete();
    //         return response()->json(null, Response::HTTP_NO_CONTENT);
    //     }
    // }

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/musics/{id}",
     *    operationId="destroy",
     *    tags={"Musics"},
     *    summary="Delete Music",
     *    description="Delete Music",
     *    @OA\Parameter(name="id", in="path", description="Id of a Book", required=true,
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

    // Note $book parameter passed in here.
    // If we had not enabled route model binding
    // when creating Controller and Model (using --Model)
    // there would only be a music Id passed in here, and we'd have to
    // check to see if the music exist.
    public function destroy(Music $music)
    {
        $music->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
