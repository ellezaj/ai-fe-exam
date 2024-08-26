<?php

namespace App\Http\Controllers;

use App\Models\Article;

class DashboardController extends Controller
{
    public function index(){
        return inertia('Dashboard', [
            'articles' => Article::with(['company', 'editor', 'writer'])->where(['status' => 2])->paginate(10),
            'published_articles' => Article::with(['company', 'editor', 'writer'])->where(['status' => 1])->paginate(10)
        ]);
    }
}
