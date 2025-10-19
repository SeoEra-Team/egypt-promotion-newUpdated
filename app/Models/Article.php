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

class Article extends Model implements HasMedia
{
    use HasFactory, CheckSlug ,InteractsWithMedia, HasTranslations, SoftDeletes, DefaultImage, CascadeSoftDeletes;

    protected $translatable = ['name', 'short_description', 'description',
        'meta_title', 'meta_keywords', 'meta_description', 'slug', 'author_name'];


    protected $casts = [
        'travel_packages'   => 'array'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::ARTICLE_MEDIA_PATH)->singleFile();
        $this->addMediaCollection(MediaHelper::ARTICLE_BANNER_MEDIA_PATH)->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {

        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::ARTICLE_BANNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::ARTICLE_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_articles', 'article_id', 'tag_id');
    }

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'article_tours', 'article_id', 'tour_id');
    }

}
