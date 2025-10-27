<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        if (Gate::denies('create-publication')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'publication_title' => 'required|string|max:255',
            'publication_author' => 'required|string|max:255',
            'publication_publisher' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'publication_page' => 'required|integer|min:1',
            'publication_ISBN' => 'required|string|size:13',
            'publication_publication_language' => 'required|integer|exists:languages,language_id',
            'publication_cover' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            $file = $request->file('publication_cover');
            $filename = uniqid('cover_') . '.' . $file->getClientOriginalExtension();
            
            $path = Storage::disk('s3')->putFileAs('covers', $file, $filename, 'public');

            if (!$path) {
                Log::error('S3 upload failed', ['filename' => $filename]);
                return response()->json(['error' => 'Failed to upload cover'], 500);
            }

            $validated['publication_cover'] = $path;
            $publication = Publication::create($validated);

            return response()->json([
                'message' => 'Publication created successfully',
                'data' => $publication,
            ], 201);

        } catch (QueryException $e) {
            Log::error('Database error', ['code' => $e->getCode()]);
            
            if ($e->getCode() == '23000') {
                return response()->json(['error' => 'Duplicate publication'], 422);
            }
            
            return response()->json(['error' => 'Database error'], 500);
            
        } catch (Exception $e) {
            Log::error('Upload error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create publication'], 500);
        }
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
