<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\BookCondition;
use App\Models\Copy;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copies = Copy::with([ 'Publication', 'Condition'])->get();
        return view('copies.index', compact('copies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publications = Publication::all();
        $conditions = BookCondition::all();
        return view('copies.create', compact('publications', 'conditions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'copy_publication_id' => ['required', 'exists:publications,publication_id'],
            'copy_condition_id' => ['required', 'exists:book_conditions,book_condition_id'],
            'copy_inventory_number' => ['required', 'unique:copies,copy_inventory_number', 'string'],
        ]);

        // Создание новой записи
        Copy::create($validated);

        return redirect()->route('copies.index')->with('success', 'Экземпляр книги добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Copy $copy)
    {
        $publications = Publication::all();
        $conditions = BookCondition::all();
        return view('copies.edit', compact('copy', 'publications', 'conditions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Copy $copy)
    {

        $validated = $request->validate([
            'copy_publication_id' => ['required', 'exists:publications,publication_id'],
            'copy_condition_id' => ['required', 'exists:book_conditions,book_condition_id'],
            'copy_inventory_number' => ['required', 'string', 'unique:copies,copy_inventory_number,'.$copy->copy_id.',copy_id'],
        ]);

        $copy->update($validated);

        return redirect()->route('copies.index')->with('success', 'Экземпляр книги обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copy $copy)
    {
        $copy->delete();
        return redirect()->route('copies.index')->with('success', 'Экземпляр книги удален');
    }
}
