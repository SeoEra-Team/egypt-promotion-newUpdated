<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\View\View;
use App\Helpers\Classes\Currency as CurrencyHelp;
use App\Models\Page;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FirstSubCategoryComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['subCategories'] = SubCategory::where('status', true)
            ->where('first', true)
            ->lang()
            ->take(9)
            ->get();
        $view->with($data);
    }
}
