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
class Destination extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, SoftDeletes;
    
    protected $translatable = ['name'];

    protected $table = 'destinations';


    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'destination_tours', 'destination_id', 'tour_id');
    }


}
