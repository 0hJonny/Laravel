<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\BookCondition;
use App\Models\BookWearCoefficient;
use App\Models\Copy;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('library-manager')) {
            abort(403, 'У вас нет прав для просмотра этой страницы');
        }
    
        $perPage = request()->input('per_page', 5);
    
        $copies = Copy::with(['Publication', 'Condition'])->paginate($perPage)->appends(['per_page' => $perPage]);
    
        return view('copies.index', compact('copies', 'perPage'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('library-manager');

        $publications = Publication::all();
        $conditions = BookCondition::all();
        $wearCoefficients = BookWearCoefficient::all();
        return view('copies.create', compact('publications', 'conditions', 'wearCoefficients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'copy_publication_id' => ['required', 'exists:publications,publication_id'],
        'copy_condition_id' => ['nullable', 'exists:book_conditions,book_condition_id'],
        'new_condition_description' => ['nullable', 'string', 'max:255'],
        'new_book_wear_coefficient' => ['nullable', 'exists:book_wear_coefficients,book_wear_coefficient_id'],
        'copy_inventory_number' => ['required', 'string', 'unique:copies,copy_inventory_number'],
    ]);

    if ($request->filled('new_condition_description') && $request->filled('new_book_wear_coefficient')) {
        $newCondition = BookCondition::create([
            'book_condition_name' => $validated['new_book_wear_coefficient'],
            'book_condition_description' => $validated['new_condition_description'],
        ]);

        $validated['copy_condition_id'] = $newCondition->book_condition_id;
    }

    Copy::create([
        'copy_publication_id' => $validated['copy_publication_id'],
        'copy_condition_id' => $validated['copy_condition_id'],
        'copy_inventory_number' => $validated['copy_inventory_number'],
    ]);

    return redirect()->route('copies.index')->with('success', 'Копия книги успешно добавлена');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $copy = Copy::findOrFail($id);
        if (Gate::denies('reader', $copy)) {
            abort(403, 'У вас нет прав для просмотра этой копии');
        }

        Gate::authorize('reader', $copy);
        return view('copies.show', compact('copy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Copy $copy)
    {
        Gate::authorize('library-manager', $copy);

        $publications = Publication::all();
        $conditions = BookCondition::all();
        return view('copies.edit', compact('copy', 'publications', 'conditions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Copy $copy)
    {
        Gate::authorize('library-manager', $copy);

        $validated = $request->validate([
            'copy_publication_id' => ['required', 'exists:publications,publication_id'],
            'copy_condition_id' => ['required', 'exists:book_conditions,book_condition_id'],
            'copy_inventory_number' => ['required', 'string', 'unique:copies,copy_inventory_number,'.$copy->copy_id.',copy_id'],
        ]);

        $copy->update($validated);
        $copy->save();

        return redirect()->route('copies.index')->with('success', 'Экземпляр книги обновлен');
    }

    public function duplicate($id)
    {
        $copy = Copy::findOrFail($id);

        Gate::authorize('library-manager');

        return view('copies.duplicate', [
            'copy' => $copy,
            'new_inventory_number' => $this->generateUniqueInventoryNumber(),
        ]);
    }

    private function generateUniqueInventoryNumber()
    {
        do {
            $newNumber = Str::random(8);
        } while (Copy::where('copy_inventory_number', $newNumber)->exists());

        return $newNumber;
    }

    public function storeDuplicate(Request $request)
    {
        Gate::authorize('library-manager');

        $validatedData = $request->validate([
            'copy_inventory_number' => ['required', 'string', 'max:255', 'unique:copies,copy_inventory_number'],
            'copy_publication_id' => ['required', 'integer', 'exists:publications,publication_id'],
            'copy_condition_id' => ['required', 'integer', 'exists:book_conditions,book_condition_id'],
        ]);

        Copy::create($validatedData);

        return redirect()->route('copies.index')->with('success', 'Запись успешно скопирована.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copy $copy)
    {
        Gate::authorize('library-manager', $copy);

        $copy->delete();
        return redirect()->route('copies.index')->with('success', 'Экземпляр книги удален');
    }
}

