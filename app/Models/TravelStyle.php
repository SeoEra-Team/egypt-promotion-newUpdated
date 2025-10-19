<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckSlug;
use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelStyle extends Model implements HasMedia, Sortable
{
    use HasFactory, CheckSlug, SortableTrait, InteractsWithMedia, HasTranslations, SoftDeletes, CascadeSoftDeletes, DefaultImage;

    protected $translatable = ['name', 'heading', 'short_description', 'description',
        'meta_title', 'meta_keywords', 'meta_description', 'slug'];

    public $sortable = [
        'sort_on_has_many' => true,
        'order_column_name' => 'sort',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::TRAVEL_STYLE_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::TRAVEL_STYLE_BANNER_MEDIA_PATH)->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::TRAVEL_STYLE_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::TRAVEL_STYLE_BANNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class,'travel_style_tours','travel_style_id','tour_id');
    }


    /**
     * @return MorphMany
     */
    public function FAQs(): MorphMany
    {
        return $this->morphMany(FaqQuestion::class, 'model');
    }

}
