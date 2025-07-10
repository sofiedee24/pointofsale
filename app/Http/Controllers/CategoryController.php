<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $sortField = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        if (
            in_array($sortField, ['name', 'created_at']) &&
            in_array($sortOrder, ['asc', 'desc'])
        ) {
            $query->orderBy($sortField, $sortOrder);
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('categorylist', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // 2. Create
        Category::create($validated);

        // 3. Redirect back with success flash
        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully!');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('editcategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        Category::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();   // hard‑delete
        // ──▶ If you prefer soft‑deletes, add `use SoftDeletes` to the model
        //     and run a migration with $table->softDeletes();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
