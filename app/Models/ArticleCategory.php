<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckSlug;
use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class ArticleCategory extends Model implements HasMedia
{
    use HasFactory, CheckSlug ,InteractsWithMedia, HasTranslations, SoftDeletes, CascadeSoftDeletes , DefaultImage;

    protected $translatable = ['name', 'heading', 'short_description', 'description',
        'meta_title', 'meta_keywords', 'meta_description', 'slug',
        'author_name'];
    protected $casts = [
        'date'              => 'date',
    ];
    protected $cascadeDeletes = ['articles'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH)->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
