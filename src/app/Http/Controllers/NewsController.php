<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function __invoke()
    {
        $news = News::with('tags')->withCount([
            'likes as likes_count' => function ($query) {
                $query->where('is_like', true);
            },
            'likes as dislikes_count' => function ($query) {
                $query->where('is_like', false);
            },
        ])->orderByRaw('(likes_count - dislikes_count) DESC')
            ->orderByDesc('publication')->paginate(2);

        return view('news', compact('news'));
    }
}
