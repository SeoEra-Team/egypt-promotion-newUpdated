<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Article;

class BlogComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['articles'] = Article::where('status', true)->where('home', true)->take(5)->get();
        $data['FirstArticle'] = $data['articles']->first();
        $view->with($data);
    }
}
