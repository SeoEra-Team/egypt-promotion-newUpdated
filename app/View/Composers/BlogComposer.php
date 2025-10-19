<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Article;

class BlogComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['blogs'] = Article::where('status', true)->take(4)->get();
        
        $view->with($data);
    }
}
