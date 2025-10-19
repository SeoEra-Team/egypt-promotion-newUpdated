<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\DefaultImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

/**
 * @method static whereStatus(bool $true)
 */
class Partner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, HasTranslations, SoftDeletes, DefaultImage;

    protected $translatable = ['name'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::PARTNER_MEDIA_PATH)->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::PARTNER_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }
}
