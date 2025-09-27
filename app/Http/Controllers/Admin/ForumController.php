<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::with(['creator', 'latestPost'])
                      ->withCount('posts')
                      ->ordered()
                      ->get();

        $categories = Forum::getCategories();

        return view('admin.forums.index', compact('forums', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Forum::getCategories();
        return view('admin.forums.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'is_pinned' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.forums.create')
                           ->withErrors($validator)
                           ->withInput();
        }

        Forum::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_active' => $request->boolean('is_active', true),
            'is_pinned' => $request->boolean('is_pinned', false),
            'order' => $request->integer('order', 0),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.forums.index')
                        ->with('success', 'Foro creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        $posts = $forum->posts()
                      ->with(['author', 'replies'])
                      ->ordered()
                      ->paginate(15);

        return view('admin.forums.show', compact('forum', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        $categories = Forum::getCategories();
        return view('admin.forums.edit', compact('forum', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'is_pinned' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.forums.edit', $forum)
                           ->withErrors($validator)
                           ->withInput();
        }

        $forum->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_active' => $request->boolean('is_active', true),
            'is_pinned' => $request->boolean('is_pinned', false),
            'order' => $request->integer('order', 0),
        ]);

        return redirect()->route('admin.forums.index')
                        ->with('success', 'Foro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums.index')
                        ->with('success', 'Foro eliminado correctamente');
    }

    /**
     * Toggle active status of the specified forum.
     */
    public function toggle(Forum $forum)
    {
        $forum->update([
            'is_active' => !$forum->is_active
        ]);

        return redirect()->route('admin.forums.index')
                        ->with('success', 'Estado del foro actualizado correctamente');
    }
}
