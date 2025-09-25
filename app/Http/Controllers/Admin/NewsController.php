<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;
use App\Models\News;
use App\Services\NewsService;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    use PaginationTrait;

    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = News::with('author');

        $news = $this->paginateWithSearchAndFilters(
            $query,
            ['title', 'excerpt', 'content'], // searchable fields
            ['status'], // filterable fields
            $request,
            'created_at',
            'desc'
        );
        
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

    public function store(NewsFormRequest $request)
    {
        // Only allow SuperAdmin and Admin users to create news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('image')) {
            $files['image'] = $request->file('image');
        }
        if ($request->hasFile('pdf')) {
            $files['pdf'] = $request->file('pdf');
        }

        $this->newsService->create($request->validated(), $files);

        return redirect()->route('admin.news.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function edit(News $news)
    {
        // Only allow SuperAdmin and Admin users to edit news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsFormRequest $request, News $news)
    {
        // Only allow SuperAdmin and Admin users to update news
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('image')) {
            $files['image'] = $request->file('image');
        }
        if ($request->hasFile('pdf')) {
            $files['pdf'] = $request->file('pdf');
        }

        $this->newsService->update($news->id, $request->validated(), $files);

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
