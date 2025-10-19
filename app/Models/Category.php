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
// use Spatie\EloquentSortable\Sortable;
// use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model implements HasMedia
{
    use HasFactory, CheckSlug,  InteractsWithMedia, HasTranslations, SoftDeletes, CascadeSoftDeletes, DefaultImage;

    protected $translatable = [
        'name',
        'menu_title',
        'heading',
        'short_description',
        'description',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    protected $cascadeDeletes = ['children'];


    public function children(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::CATEGORY_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::CATEGORY_BANNER_MEDIA_PATH)->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::CATEGORY_BANNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::CATEGORY_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }
}
