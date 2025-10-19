<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Currency extends Model implements Sortable
{
    use HasFactory, HasTranslations, UnicodeJsonColumn, SortableTrait;


    protected $translatable = ['name'];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

}
