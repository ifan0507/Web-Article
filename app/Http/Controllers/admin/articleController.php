<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $data = [
            'title' => 'Article',
            'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(10)->onEachSide(3)->withQueryString(),
        ];

        return view('admin.articles.article', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'category' => Category::all(),
            'author' => User::all()
        ];

        return view('admin.articles.create_article', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'author' => 'required',
            'category' => 'required'
        ]);

        $slug = Str::of($request->title)->slug('-');
        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'author_id' => $request->author,
            'category_id' => $request->category,
            'body' => $request->description
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
    public function edit(Post $post)
    {
        $data = [
            'title' => 'Update Article',
            'post' => $post,
            'category' => Category::all(),
            'author' => User::all()
        ];

        return view('admin.articles.edit-article', compact('post'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ], [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required'
        ]);

        $slug = Str::of($request->title)->slug('-');
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'author_id' => $request->author,
            'category_id' => $request->category,
            'body' => $request->description
        ];

        Post::where('id', $id)->update($data);
        Session::flash('status', 'Diperbarui');
        return redirect()->route('article');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::where('id', $id)->delete();
        Session::flash('status', 'Dihapus');
        return redirect()->route('article');
    }
}
