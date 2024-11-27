<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use App\Models\Reader;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $loans = Loan::with(['Copy', 'Reader'])->paginate($perPage)->appends(['per_page' => $perPage]);

        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $readers = Reader::all();
        $copies = Copy::all();
        return view('loans.create', compact('readers', 'copies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_reader_id' => ['required', 'exists:readers,reader_id'],
            'loan_copy_id' => ['required', 'exists:copies,copy_id'],
            'loan_date' => ['required', 'date'],
            'loan_return_date' => ['nullable', 'date'],
            'loan_return_date_plan' => ['nullable', 'date'],
        ]);

        $existingLoan = Loan::where('loan_reader_id', $validated['loan_reader_id'])
            ->where('loan_copy_id', $validated['loan_copy_id'])
            ->first();

        if ($existingLoan) {
            return redirect()->route('loans.create')
                ->with('error', 'Этот читатель уже взял этот экземпляр книги.');
        }

        Loan::create([
            'loan_reader_id' => $validated['loan_reader_id'],
            'loan_copy_id' => $validated['loan_copy_id'],
            'loan_date' => $validated['loan_date'],
            'loan_return_date' => $request->get('loan_return_date', null),
            'loan_return_date_plan' => $request->get('loan_return_date_plan', null),
        ]);

        return redirect()->route('loans.index')->with('success', 'Долг успешно добавлен');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loan = Loan::with(['copy', 'reader'])->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $loan = Loan::with(['copy', 'reader'])->findOrFail($id);
        $readers = Reader::all();
        $copies = Copy::all();

        return view('loans.edit', compact('loan', 'readers', 'copies'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'loan_reader_id' => ['required', 'exists:readers,reader_id'],
            'loan_copy_id' => ['required', 'exists:copies,copy_id'],
            'loan_date' => ['required', 'date'],
            'loan_return_date' => ['nullable', 'date'],
            'loan_return_date_plan' => ['nullable', 'date'],
        ]);


        $loan = Loan::findOrFail($id);

        $loan->update([
            'loan_reader_id' => $validated['loan_reader_id'],
            'loan_copy_id' => $validated['loan_copy_id'],
            'loan_date' => $validated['loan_date'],
            'loan_return_date' => $request->get('loan_return_date', null),
            'loan_return_date_plan' => $request->get('loan_return_date_plan', null),
        ]);
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Долг успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Долг успешно удалён.');
    }
}
