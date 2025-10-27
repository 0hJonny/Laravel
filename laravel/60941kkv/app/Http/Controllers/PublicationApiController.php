<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = (int) $request->get('page', 0);     // начиная с 0
        $perPage = (int) $request->get('perpage', 10); // по умолчанию 10

        $publications = Publication::paginate($perPage, ['*'], 'page', $page + 1);

         return response()->json([
            'data' => $publications->items(),
            'current_page' => $publications->currentPage(),
            'per_page' => $publications->perPage(),
            'total_pages' => $publications->lastPage(),
        ]);

        // return response()->json(Publication::all(), 200);
    }

    public function total()
    {
        return response()->json([
            'total' => Publication::count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publication = Publication::find($id);
        if (! $publication) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($publication, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
