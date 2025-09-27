<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\ForumVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the forums.
     */
    public function index()
    {
        $forums = Forum::with(['creator', 'latestPost'])
                      ->withCount('posts')
                      ->active()
                      ->ordered()
                      ->paginate(12); // 12 forums per page

        $categories = Forum::getCategories();

        // Configuración de la página
        $pageSettings = [
            'title' => 'Foros de Discusión',
            'subtitle' => 'Espacio de diálogo y intercambio de ideas entre hermanos masones.',
            'banner_image' => 'https://picsum.photos/seed/forums-hero/1920/1080',
        ];

        return view('public.forums', compact('forums', 'categories', 'pageSettings'));
    }

    /**
     * Display the specified forum with its posts.
     */
    public function show(Forum $forum)
    {
        if (!$forum->is_active) {
            abort(404);
        }

        // Increment forum views
        $forum->incrementViews();

        // Update last activity
        $forum->updateLastActivity();

        $posts = $forum->posts()
                       ->with(['author', 'parent', 'replies'])
                       ->ordered()
                       ->paginate(15);

        // Configuración de la página
        $pageSettings = [
            'title' => $forum->title,
            'subtitle' => $forum->description,
            'banner_image' => 'https://picsum.photos/seed/forum-' . $forum->id . '/1920/1080',
        ];

        return view('public.forum-show', compact('forum', 'posts', 'pageSettings'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function storePost(Request $request, Forum $forum)
    {
        if (!$forum->is_active) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:forum_posts,id',
        ]);

        ForumPost::create([
            'forum_id' => $forum->id,
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'is_approved' => true, // Por defecto aprobamos todos los posts
            'likes_count' => 0,
            'dislikes_count' => 0,
            'views_count' => 0,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('public.forums.show', $forum)
                        ->with('success', 'Publicación creada correctamente');
    }

    /**
     * Handle voting on forum posts
     */
    public function vote(Request $request, ForumPost $post)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Debes iniciar sesión para votar'], 401);
        }

        $request->validate([
            'vote_type' => 'required|in:like,dislike'
        ]);

        $userId = Auth::id();
        $voteType = $request->vote_type;

        // Check if user already voted
        $existingVote = $post->votes()->byUser($userId)->first();

        if ($existingVote) {
            if ($existingVote->vote_type === $voteType) {
                // User is trying to vote the same way, remove the vote
                $post->removeVote($userId);
                $userVote = null;
            } else {
                // User is changing their vote
                if ($voteType === 'like') {
                    $post->addLike($userId);
                } else {
                    $post->addDislike($userId);
                }
                $userVote = $voteType;
            }
        } else {
            // New vote
            if ($voteType === 'like') {
                $post->addLike($userId);
            } else {
                $post->addDislike($userId);
            }
            $userVote = $voteType;
        }

        // Update forum's last activity
        $post->forum->updateLastActivity();

        return response()->json([
            'success' => true,
            'votes' => $post->likes_count - $post->dislikes_count,
            'user_vote' => $userVote
        ]);
    }

}