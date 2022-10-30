<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtistCollection;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

//Artist Contoller page to display the Get methods on Swagger

///////////////////////////////////////////////////////////////////

class ArtistController extends Controller
{
    /**
     * Display a listing of the Artists.
     *
     * @OA\Get(
     *     path="/api/artists",
     *     description="Displays all the Artists",
     *     tags={"Artists"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Artists in JSON format"
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
    //Get all
    {
        return new ArtistCollection(Artist::all());
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //store new artist
    {
        $artist = Artist::create($request->only([
            'name', 'label'
        ]));

        return new ArtistResource($artist);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Display the specified Artists by {id}.
     * @OA\Get(
     *     path="/api/artists/{id}",
     *     description="Gets an Artist by ID",
     *     tags={"Artists"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Artist ID",
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
     * @param  \App\Models\Artist  $book
     * @return \Illuminate\Http\ArtistResource
     */
    public function show(Artist $artist)
    //get artist by {id}
    {
        return new ArtistResource($artist);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    //update artist
    {
        $artist->update($request->only([
            'name', 'label'
        ]));

        return new ArtistResource($artist);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    //deletes artist
    {
        $artist->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

///////////////////////////////////////////////////////////////////
