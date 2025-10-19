<?php

namespace App\Models;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Traits\CheckSlug;
use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia, HasTranslations, SoftDeletes, DefaultImage, CascadeSoftDeletes;

    protected $translatable = [
        'name',
        'traveler_from',
        'description',
    ];

    

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaHelper::TESTIMONIAL_MEDIA_PATH)->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->performOnCollections(MediaHelper::TESTIMONIAL_MEDIA_PATH)
            ->format(Manipulations::FORMAT_WEBP);
    }
}
