<?php

namespace App\Helpers\Constants;

use App\Models\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GeneralHelper
{
    const CURRENCY_SESSION = 'currency';
    const COUNTRY_SESSION = 'country';

    public static function getTypes() {
        return Category::whereStatus(true)->distinct()->pluck('type');
    }

    /**
     * @return int
     */
    public static function getTypePosition(): int
    {
        if(LaravelLocalization::getCurrentLocale() == LaravelLocalization::getDefaultLocale())
            return 1;
        return 2;
    }
}
