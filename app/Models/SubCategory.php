<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckLang;
use App\Helpers\Traits\CheckSlug;
use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model implements HasMedia, Sortable
{
    use HasFactory, CheckSlug,CheckLang ,InteractsWithMedia, SortableTrait, HasTranslations, SoftDeletes, CascadeSoftDeletes, DefaultImage;

    protected $translatable = ['name', 'menu_title', 'heading', 'short_description', 'description',
        'meta_title',  'slug', 'meta_keywords', 'meta_description'];

    protected $cascadeDeletes = ['tours'];

    public $sortable = [
        'order_column_name' => 'sort', 
        'sort_on_has_many' => true
    ];

    protected $casts = [
        
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::SUB_CATEGORY_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::SUB_CATEGORY_BANNER_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::SUB_CATEGORY_SUBIMG_MEDIA_PATH)->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::SUB_CATEGORY_BANNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::SUB_CATEGORY_SUBIMG_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::SUB_CATEGORY_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function tours()
    {
        return $this->hasMany(Tour::class);
    }


    public function faqs(): MorphMany
    {
        return $this->morphMany(FaqQuestion::class, 'model');
    }

}
