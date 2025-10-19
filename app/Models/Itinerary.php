<?php

namespace App\Models;

use App\Helpers\Traits\CheckSlug;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Itinerary extends Model 
{
    use HasFactory, CheckSlug, SortableTrait, SoftDeletes, HasTranslations, SoftDeletes, CascadeSoftDeletes;

    protected $translatable = ['heading', 'description'];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
    

}
