<?php

namespace App\Helpers\Traits;

trait CheckSlug
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeCheckSlug($query): mixed
    {
        return $query->whereNotNull('slug->' . app()->getLocale());
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSlug($query, $value): mixed
    {
        return $query->where('slug->' . app()->getLocale(), $value);
    }
}
