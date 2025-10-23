<?php

namespace App\Http\Controllers\Tour;

use App\Helpers\Classes\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourReservationRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\City;
use App\Models\Destination;
use App\Models\FaqQuestion;
use App\Models\Reservation;
use App\Models\SubCategory;
use App\Models\Tour;
use App\Models\TravelStyle;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TourController extends Controller
{
    public function getSubCategories($slug)
    {
        $category = Category::with([
            'children' => function ($query) {
                $query->where('status', true);
                $query->lang();
            }
        ])->slug($slug)->first();
        $faqs     = $this->getRelatedFaqsData($category->id, 'App\Models\Category');
        return view('tour.sub_categories', compact('category', 'faqs'));
    }

    public function tours(Request $request, $categorySlug, $subCategorySlug)
    {
        $tours = Tour::query();
        // dd($request->all());
        $subCategory = SubCategory::slug($subCategorySlug)->first();
        $tours = $this->partialsFilter($tours, $request, $subCategory);

        $faqs = $this->getRelatedFaqsData($subCategory->id, 'App\Models\SubCategory');
        $cities = City::all();
        $destinations = Destination::all();
        $travelStyles = TravelStyle::where('status', 1)->get();
        // dd($travelStyles);
        $prices = collect($subCategory->tours)->pluck('price')->unique()->toArray();
        return view('tour.tours', compact('subCategory', 'faqs', 'cities', 'destinations', 'prices', 'tours', 'travelStyles'));
    }


    public function show($categorySlug, $subCategorySlug, $slug)
    {
        $tour = Tour::with('faqs', 'itineraries')->slug($slug)->first();
        $priceCategories = [];
        if ($tour->type == 'package') {
            $priceCategories = collect($tour->pricing)->map(function ($row) {
                return $row['attributes']['title'][LaravelLocalization::getCurrentLocale()];
            })->toArray();
            // dd($data['itinerariesGroups']);
        }
        $relatedTours = Tour::where('sub_category_id', $tour->sub_category_id)->where('id', '!=', $tour->id)->get();
        // dd($relatedTours);
        $faqs = $this->getRelatedFaqsData($tour->id, 'App\Models\Tour');
        return view('tour.show', compact('tour', 'priceCategories', 'relatedTours', 'faqs'));
    }

    public function reservation(TourReservationRequest $request, $id)
    {

        $data = $request->validated();
        // dd($data);
        $tour = Tour::where('id', $id)->first();

        if (!$tour) {
            return back()->withErrors(['tour' => 'Tour not found.'])->withInput();
        }

        $data['total'] = $this->getTheFinalPrice($id, $data);
        $data['tour_id'] = $id;
        // dd($data['total']);
        $data['phone_number'] = "+" . $data['code'] . "" . $data['phone_number'];
        $tourReservation = Reservation::create($data);
        $reservationMadeMails = Email::getReceiversMails('reservation');
        try {
            Email::send($tourReservation, __('messages.reservation_mail_message'), $reservationMadeMails, 'mails.reservation', __('messages.reservation_mail_subject') . ' #' . $tourReservation->id);
        } catch (\Throwable $th) {
        }
        return redirect()->route('thanks')->with('reservation_id', $tourReservation->id);
    }


    public function getTheFinalPrice($tourId, $request)
    {
        $tour = Tour::where('id', $tourId)->first();
        $basicPrice = $tour->final_price;
        $children_price = env('RATE_CHILDREN', 0);
        $price = $basicPrice * $request['adults'];
        if ($request['children'] > 0) {
            $price += ($children_price  * $request['children']) * $basicPrice;
        }
        if ($request['infants'] > 0) {
            $price += ($tour->infants_price * $request['infants']) * $basicPrice;
        }
        return $price;
    }

    public function specialOffers()
    {
        $tours = Tour::where('offer', 1)->where('status', 1)->get();
        $articles = Article::where('offer', 1)->where('status', 1)->get();
        return view('tour.special_offers', compact('tours', 'articles'));
    }

    public function getRelatedFaqs($modelId, $modelType)
    {
        $faqs = FaqQuestion::where('model_id', $modelId)->where('model_type', $modelType)->get();
        return $faqs;
    }

    public function getRelatedFaqsData($modelId, $modelType)
    {
        // Check for FAQs at the given model level
        $faqs = FaqQuestion::where('model_id', $modelId)->where('model_type', $modelType)->get();

        if ($faqs->count() > 0) {
            return $faqs;
        }

        // If no FAQs found, check the next level based on model type
        if ($modelType === 'App\Models\Tour') {
            $tour = Tour::find($modelId);
            if ($tour && $tour->sub_category_id) {
                return $this->getRelatedFaqsData($tour->sub_category_id, 'App\Models\SubCategory');
            }
        } elseif ($modelType === 'App\Models\SubCategory') {
            $subCategory = SubCategory::find($modelId);
            if ($subCategory && $subCategory->category_id) {
                return $this->getRelatedFaqsData($subCategory->category_id, 'App\Models\Category');
            }
        }

        // Return empty collection if no FAQs found at any level
        return collect([]);
    }

    public function partialsFilter($tours, $request, $subCategory)
    {
        $tours = $tours;

        if ($request->has('destination')) {
            $tours = $tours->with('destinations')->whereHas('destinations', function ($q) use ($request) {
                $q->where('destinations.id', $request->destination); // Specify the table
            });
        }

        if ($request->has('city')) {
            $tours = $tours->with('cities')->whereHas('cities', function ($q) use ($request) {
                $q->where('cities.id', $request->city); // Specify the table
            });
        }

        if ($request->has('type')) {
            $tours = $tours->with('travelStyles')->whereHas('travelStyles', function ($q) use ($request) {
                $q->where('travel_styles.id', $request->type); // Specify the table
            });
        }

        if ($request->has('price')) {
            $tours = $tours->orderBy('price', $request->price);
        }

        $tours = $tours->where('sub_category_id', $subCategory->id);
        $tours = $tours->where('status', 1);
        return $tours->get();

    }

}
