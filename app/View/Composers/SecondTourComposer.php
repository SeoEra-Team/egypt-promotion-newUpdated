<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\View\View;
use App\Helpers\Classes\Currency as CurrencyHelp;
use App\Models\Page;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SecondTourComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['secondTours'] = Tour::where('status', true)->where('second', true)->get();
        // dd($data['secondTours']);
        $view->with($data);
    }
}
