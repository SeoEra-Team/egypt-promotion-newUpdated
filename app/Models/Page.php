<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Traits\DefaultImage;

/**
 * @method static whereStatus(bool $true)
 */
class Page extends Model implements HasMedia
{
    use HasFactory, CheckSlug,InteractsWithMedia, DefaultImage, HasTranslations, SoftDeletes;

    protected $translatable = ['heading', 'sub_heading', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'slug'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::PAGE_BANNER_MEDIA_PATH)->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::PAGE_BANNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);

    }
    
    
}
