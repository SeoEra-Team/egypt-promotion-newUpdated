<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckSlug;
use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @method static whereStatus(bool $true)
 */
class Tour extends Model implements HasMedia, Sortable
{
    use HasFactory,CheckSlug ,InteractsWithMedia, SortableTrait, SoftDeletes, HasTranslations, SoftDeletes, CascadeSoftDeletes, DefaultImage;

    protected $translatable = 
    [
        'name', 'heading', 
        'short_description', 
        'price_notes', 'overview', 
        'highlights', 'inclusion', 
        'exclusion','notes', 
        'duration','location', 
        'tour_type','tour_availability',
        'meta_title', 'meta_keywords', 
        'meta_description',
        'live_tour_guide',
        'slug',
    ];

    protected $casts = [
        'pricing' => 'array',
        'quick_tips' => 'array',
    ];

    protected $cascadeDeletes = [];
    protected $append = ['final_price'];

    public $sortable = [
        'sort_on_has_many' => true,
        'order_column_name' => 'sort',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::TOUR_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::TOUR_BANNER_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::TOUR_GALLERY_MEDIA_PATH);
    }

    public function registerMediaConversions(Media $media = null): void
    {
       
        
        $this->addMediaConversion('small')
            ->performOnCollections(MediaHelper::TOUR_GALLERY_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
        
        $this->addMediaConversion('large')
            ->performOnCollections(MediaHelper::TOUR_GALLERY_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);

    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }


    public function getFinalPriceAttribute(): float
    {
        $price = $this->price??0;
        $discount = $this->discount;

        if($discount) {
            if($this->discount_type == 'number') {
                return $price - $discount;
            } else {
                return $price - ($price*($discount/100));
            }
        }else{
            if(optional($this->category)->discount){
                if($this->category->discount_type == 'number') {
                    return $price - $this->category->discount;
                } else {
                    return $price - ($price*($this->category->discount/100)) ;
                }
            }
        }

        return $price??0;
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_tours', 'tour_id', 'destination_id');
    }


    public function itineraries()
    {
        return $this->hasMany(Itinerary::class);
    }

    public function faqs()
    {
        return $this->morphMany(FaqQuestion::class, 'model');
    }

    public function travelStyles()
    {
        return $this->belongsToMany(TravelStyle::class, 'travel_style_tours', 'tour_id', 'travel_style_id');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_tours', 'tour_id', 'article_id');
    }

}
