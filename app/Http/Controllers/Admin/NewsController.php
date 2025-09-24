<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = News::with('author');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply date filter
        if ($request->filled('date_from') || $request->filled('date_to')) {
            if ($request->filled('date_from')) {
                $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
            }
            if ($request->filled('date_to')) {
                $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
            }
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10)->appends(request()->query());
        
        // Separar noticias por estado para mostrar en las pestañas
        $published = $news->where('status', 'published');
        $drafts = $news->where('status', 'draft');
        $scheduled = $news->where('status', 'scheduled');
        
        return view('admin.news', compact('news', 'published', 'drafts', 'scheduled'));
    }

    public function create()
    {
        // Only allow SuperAdmin and Admin users to create news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        // Only allow SuperAdmin and Admin users to create news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
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
        // Only allow SuperAdmin and Admin users to edit news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        // Only allow SuperAdmin and Admin users to update news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
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
        // Only allow SuperAdmin and Admin users to delete news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $news->delete();
        
        return redirect()->route('admin.news.index')->with('success', 'Noticia eliminada exitosamente.');
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
