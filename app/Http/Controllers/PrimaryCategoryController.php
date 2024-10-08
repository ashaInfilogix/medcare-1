<?php

namespace App\Http\Controllers;

use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PrimaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_primary_categories_index()
    {
        return view('admin.primary-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.primary-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:primary_categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/primary-categories/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        PrimaryCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.primary-categories.index')->with('success', 'Primary category saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

        $query = PrimaryCategory::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('name', 'like', "%{$search}%");
        }

        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $data = $query->skip($request->start)->take($request->length)->get();

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrimaryCategory $primaryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrimaryCategory $primaryCategory)
    {
        return view('admin.primary-categories.edit', compact('primaryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrimaryCategory $primaryCategory)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('primary_categories')->ignore($primaryCategory->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = $primaryCategory->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $base_image_path = 'uploads/primary-categories/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $primaryCategory->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.primary-categories.index')->with('success', 'Primary Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimaryCategory $primaryCategory)
    {
        $imagePath = $primaryCategory->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $primaryCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Primary category deleted successfully.'
        ]);
    }
}
