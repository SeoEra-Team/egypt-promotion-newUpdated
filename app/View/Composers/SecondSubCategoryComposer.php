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

class SecondSubCategoryComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['subCategories'] = SubCategory::where('status', true)
            ->where('second', true)
            ->lang()
            ->with([
                'tours' => function ($query) {
                    $query->where('status', true);
                    $query->where('third', true);
                    $query->lang();
                    $query->take(6);
                }
            ])
            ->take(4)
            ->get();
        $view->with($data);
    }
}
