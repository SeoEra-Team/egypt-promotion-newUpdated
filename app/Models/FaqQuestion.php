<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class FaqQuestion extends Model implements Sortable
{
    use HasFactory, HasTranslations, SortableTrait;

    protected $translatable = ['question', 'answer'];
    public $sortable = [
        'sort_on_has_many' => true,
        'order_column_name' => 'sort',
    ];
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
