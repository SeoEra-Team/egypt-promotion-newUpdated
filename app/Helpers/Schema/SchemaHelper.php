<?php

namespace App\Helpers\Schema;

use App\Helpers\Constants\MediaHelper;
use Illuminate\Support\Facades\Storage;

class SchemaHelper
{
    public static function jsonBreadcrumb($itemListElement)
    {      
        // dd($itemListElement);  
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => __('general.home'),
                    'item' => route('home')
                ]
            ]
        ];

        foreach ($itemListElement as $index => $item) {
            // dd($index, $item);
            $breadcrumb['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' =>   2,
                'name' => $item['name'],
                'item' => $item['url']
            ];
        }

        return json_encode($breadcrumb, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);;
    }
}
