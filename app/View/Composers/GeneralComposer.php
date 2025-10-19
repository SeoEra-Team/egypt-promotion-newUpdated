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
        
        $data['homeServiceItems'] = nova_get_setting('home_service_items', []);
        $data['socialMedia'] = nova_get_setting('social_media', []);
        $data['headercategories'] = Category::where('status', true)->where('header', true)->with('children')->get();
        $data['footerCategories'] = Category::where('status', true)->where('footer', true)->with('children')->take(2)->get();
        $data['wishlistPage']     = Page::where('type', 'wishlist')->first();
        $data['travelStyles']      = TravelStyle::where('status', true)->get();
        // dd($data['wishlistPage']);
        $view->with($data);
    }
}
