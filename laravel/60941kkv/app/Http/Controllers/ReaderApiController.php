<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = (int) $request->get('page', 0);
        $perPage = (int) $request->get('perpage', 10);

        $readers = Reader::paginate($perPage, ['*'], 'page', $page + 1);

        return response()->json([
            'data' => $readers->items(),
            'current_page' => $readers->currentPage(),
            'per_page' => $readers->perPage(),
            'total_pages' => $readers->lastPage(),
        ]);

        // return response()->json(Reader::all(), 200);
    }

    public function total()
    {
        return response()->json([
            'total' => Reader::count(),
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
        $reader = Reader::find($id);
        if (! $reader) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($reader, 200);
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
