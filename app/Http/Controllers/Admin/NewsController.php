<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // El segundo argumento 'public' usa el disco configurado en filesystems.php
            // que ahora apunta a public/uploads.
            // El primer argumento es la subcarpeta dentro de 'uploads'.
            $imagePath = $request->file('image')->store('news', 'public');
        }

        News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image_path' => $imagePath,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Noticia creada exitosamente.');
    }
}
