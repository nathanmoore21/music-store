<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
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
        // return new ArtistCollection(Artist::paginate(1));
        return new ArtistCollection(Artist::all());
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Store a newly created song in storage.
     *
     * @OA\Post(
     *      path="/api/artists",
     *      tags={"Artists"},
     *      summary="Create a new artist",
     *      description="Stores the artist in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "label"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="label", type="string", format="string", example="Label Company")
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
    public function store(StoreArtistRequest $request)
    //store new artist
    {
        $artist = Artist::create([
            'name' => $request->name,
            'label' => $request->label
        ]);

        //calls for validation rules
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
    public function update(UpdateArtistRequest $request, Artist $artist)
    //update artist
    {
        $artist->update($request->all());
    }

    ///////////////////////////////////////////////////////////////////

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/artists/{id}",
     *      tags={"Artists"},
     *      summary="Create a new artist",
     *      description="Stores the artist in the DB",
     *      security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of an artist", required=true,
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

    public function destroy(Artist $artist)
    //deletes artist
    {
        $artist->delete();
    }
}

///////////////////////////////////////////////////////////////////
