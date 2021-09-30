<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Article;

class ArticleController extends Controller
{
    //
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $article = new Article();
        $article->name_article = $request->name_article;
        $article->content_article = $request->content_article;
        $article->save();
    }
}
