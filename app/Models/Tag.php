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

class Tag extends Model implements Sortable
{
    use HasFactory, CheckSlug, SortableTrait, HasTranslations, SoftDeletes, CascadeSoftDeletes;

    protected $translatable = ['name', 'description',
        'meta_title', 'meta_keywords', 'meta_description', 'slug'];

    public $sortable = [
        'sort_on_has_many' => true,
        'order_column_name' => 'sort',
    ];  

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'tag_tours', 'tag_id', 'article_id');
    }
}
