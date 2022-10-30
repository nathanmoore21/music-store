<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Response;

//Genre Contoller page to display the Get methods on Swagger

///////////////////////////////////////////////////////////////////

class GenreController extends Controller
{
    /**
     * Display a listing of the generes.
     *
     * @OA\Get(
     *     path="/api/genres",
     *     description="Displays all the genres",
     *     tags={"Genres"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of genres in JSON format"
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
        return new GenreCollection(Genre::all());
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //store new genre
    {
        $genre = Genre::create($request->only([
            'genre'
        ]));

        return new GenreResource($genre);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Display the specified genres by {id}.
     * @OA\Get(
     *     path="/api/genres/{id}",
     *     description="Gets an genre by ID",
     *     tags={"Genres"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Genre ID",
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
     * @param  \App\Models\Genre  $book
     * @return \Illuminate\Http\GenreResource
     */
    public function show(Genre $genre)
    //get genre by {id}
    {
        return new GenreResource($genre);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    //update genre
    {
        $genre->update($request->only([
            'genre'
        ]));

        return new GenreResource($genre);
    }

    ///////////////////////////////////////////////////////////////////

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    //deletes genre
    {
        $genre->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

///////////////////////////////////////////////////////////////////
