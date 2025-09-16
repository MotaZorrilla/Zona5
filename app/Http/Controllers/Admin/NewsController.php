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
        // Obtener todas las noticias con sus autores, ordenadas por fecha de creación
        $news = News::with('author')->orderBy('created_at', 'desc')->get();
        
        // Separar noticias por estado
        $published = $news->where('status', 'published');
        $drafts = $news->where('status', 'draft');
        $scheduled = $news->where('status', 'scheduled');
        
        return view('admin.news', compact('news', 'published', 'drafts', 'scheduled'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news/images', 'public');
        }

        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('news/pdfs', 'public');
        }

        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = now();
        } elseif ($request->status === 'scheduled' && $request->published_at) {
            $publishedAt = $request->published_at;
        }

        News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $news->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news/images', 'public');
        }

        $pdfPath = $news->pdf_path;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('news/pdfs', 'public');
        }

        $publishedAt = $news->published_at;
        if ($request->status === 'published' && !$news->published_at) {
            $publishedAt = now();
        } elseif ($request->status === 'scheduled' && $request->published_at) {
            $publishedAt = $request->published_at;
        } elseif ($request->status === 'draft') {
            $publishedAt = null;
        }

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Noticia actualizada exitosamente.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        
        return redirect()->route('admin.news.index')->with('success', 'Noticia eliminada exitosamente.');
    }
}
