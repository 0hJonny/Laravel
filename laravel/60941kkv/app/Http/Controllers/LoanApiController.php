<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = (int) $request->get('page', 0);
        $perPage = (int) $request->get('perpage', 10);

        $loans = Loan::with(['copy.publication', 'reader'])
                     ->paginate($perPage, ['*'], 'page', $page + 1);

        return response()->json([
            'data' => $loans->items(),
            'current_page' => $loans->currentPage(),
            'per_page' => $loans->perPage(),
            'total_pages' => $loans->lastPage(),
        ]);

        // return response()->json(Loan::all(), 200);
    }

    public function total()
    {
        return response()->json([
            'total' => Loan::count(),
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
        $loan = Loan::find($id);
        if (! $loan) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($loan, 200);
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
