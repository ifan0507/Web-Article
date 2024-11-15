<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Categories',
            'category' => Category::where('delete_at', '0')->latest()->paginate(10)
        ];
        return view('admin.categorys.category', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create Category',
        ];
        return view('admin.categorys.create_category', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|max:7',
        ]);

        // Create a new category
        $slug = Str::of($request->name)->slug('-');
        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'color' => $request->color
        ]);

        // Redirect to the category listing page
        Session::flash('status', 'Disimpan');
        return redirect()->route('category');
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
    public function edit(Category $category)
    {
        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        return view('admin.categorys.edit_category', compact('category'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|max:7',
        ]);

        $slug = Str::of($request->name)->slug('-');
        $data = [
            'name' => $request->name,
            'color' => $request->color,
            'slug' => $slug
        ];

        Category::where('id', $id)->update($data);
        Session::flash('status', 'Diperbaharui');
        return redirect()->route('category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->update(['delete_at' => '1']);
        Session::flash('status', 'Dihapus');
        return redirect()->route('category');
    }
}
