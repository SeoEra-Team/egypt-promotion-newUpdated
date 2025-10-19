<?php

namespace App\Helpers\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait DefaultImage
{
    protected static string $defaultImage = '/assets/images/logo.png';

    /**
     * @param string $collectionName
     * @param string $conversionName
     * @return array
     */
    public function getFirstMediaUrlOrDefault(string $collectionName = '', string $conversionName = ''): array
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);
        $default = $this::$defaultImage;

        $collection = $this->getFirstMedia($collectionName);

        if($collection) {
            $title = json_decode($collection->img_title, true)[$locale] ?? $this->name;
            $alt = json_decode($collection->img_alt, true)[$locale] ?? $this->name;
        } else {
            $title = $this->name;
            $alt = $this->name;
        }

        return [
            'url' => strlen($url) > 1 ? $url : $default,
            'title' => $title,
            'alt' => $alt
        ];
    }
}
