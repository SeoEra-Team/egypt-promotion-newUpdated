<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\View\View;
use App\Helpers\Classes\Currency as CurrencyHelp;
use App\Models\Page;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\TravelStyle;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GeneralComposer
{
    public function compose(View $view)
    {
        CurrencyHelp::setDefault();
        $data = [];
        $data['currencies'] = DB::table('currencies')
            ->select(['id', 'name', 'code', 'symbol'])
            ->where('status', true)
            ->get();

        $data['socialMedia'] = nova_get_setting('social_media', []);
        $data['headercategories'] = Category::where('status', true)
            ->where('header', 1)
            ->where(function ($query) {
                $query->where('type', '!=', 'dahabiya')
                    ->orWhereNull('type');
            })
            ->lang()
            ->with(['children' => function ($query) {
                $query->where('status', true);
                $query->where('header', true);
                $query->lang();
            }])
            ->take(3)
            ->get();
        // dd($data['headercategories']);
        $data['footerCategories'] = Category::where('status', true)
            ->where('footer', true)
            ->with(['children' => function ($query) {
                $query->where('status', true);
                $query->where('footer', true);
                $query->lang();
                // $query->take(5);
            }])
            ->take(2)
            ->get();
            // dd($data['footerCategories']);
        // $data['DahabiyaCategories'] = Category::where('status', true)
        //     ->where('type', 'dahabiya')
        //     ->with(['children' => function ($query) {
        //         $query->where('status', true);
        //         $query->where('dahabiya', true);
        //         $query->lang();
        //         $query->first();
        //         $query->with(['tours' => function ($query) {
        //             $query->where('status', true);
        //             $query->where('header', true);
        //             $query->lang();
        //         }]);
        //     }])->first();
            // dd($data['DahabiyaCategories']->children->first()->tours);
        $view->with($data);
    }
}
