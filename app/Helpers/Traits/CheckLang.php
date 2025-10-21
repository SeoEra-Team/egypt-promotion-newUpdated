<?php

namespace App\Helpers\Traits;

trait CheckLang
{

    public function scopeLang($query): mixed
    {
        return $query->whereNotNull('name->' . app()->getLocale());
        // $query->whereNotNull('slug->' . app()->getLocale());
    }
}
