<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Article;
use App\Models\Testimonial;

class TestimonialComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['testimonials'] = Testimonial::all();
        
        $view->with($data);
    }
}
