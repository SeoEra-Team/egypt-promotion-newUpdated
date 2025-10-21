<?php

namespace App\Http\Controllers\Home;

use App\Helpers\Classes\Email;
use App\Helpers\Constants\GeneralHelper;
use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Schema\SchemaHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\FaqQuestion;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\SubCategory;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TravelStyle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Facades\Session;
use App\Service\HomeService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        $data = Cache::remember('home_full_data', now()->addHours(2), function () {
            return [
                'infoList' => nova_get_setting('info_list', []),
            ];
        });
        // dd($whyUsSection);
        return view('home.index', compact('data'));
    }

    public function switchCurrency(Request $request): RedirectResponse
    {

        $currency = Currency::whereStatus(true)
            ->whereId($request->id)->firstOrFail(['id', 'code', 'symbol', 'rate']);
        // dd($currency);
        session()->put([
            GeneralHelper::CURRENCY_SESSION => $currency
        ]);
        return redirect()->back();
    }

    public function about()
    {
        $jsonBreadcrumb = $this->jsonBreadcrumb('about');
        return view('page.about', compact('jsonBreadcrumb'));
    }

    public function thanks()
    {
        return view('thanks.index');
    }


    public function savesubscribe()
    {
        $subscribe = new Subscribe();
        $subscribe->email = request('email');
        $subscribe->save();
        return back()->with('success', __('general.subscribe_successfully'));
    }

    public static function jsonBreadcrumb($type)
    {
        $itemListElement = [];
        if ($type == 'wishlist') {
            $itemListElement = [
                [
                    'name' => nova_get_setting_translate('wishlist_title', env('APP_NAME')),
                    'url' => route('wishlist.index')
                ]
            ];
        } elseif ($type == 'about') {
            $itemListElement = [
                [
                    'name' => nova_get_setting_translate('about_title', env('APP_NAME')),
                    'url' => route('about.index', nova_get_setting_translate('about_slug') ?? 'about-us')
                ]
            ];
        }

        // dd($itemListElement);
        $Breadcrumb = SchemaHelper::jsonBreadcrumb($itemListElement);
        return $Breadcrumb;
    }
}
