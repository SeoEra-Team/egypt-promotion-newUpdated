<?php

namespace App\Helpers\Schema;

use App\Helpers\Constants\MediaHelper;
use Illuminate\Support\Facades\Storage;

class SchemaArticlesHelper
{
    public static function jsonArticlecrumb($article)
    {
        // Prepare dynamic data from the article object and nova_get_setting
        // dd($article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url']);
        $data = [
            '@context' => 'https://schema.org',
            '@type' => nova_get_setting('schema_type', 'Article'),
            'headline' => $article->title ?? nova_get_setting('page_title', 'Egypt Travel Guide Tips'),
            'description' =>  strip_tags($article->description) ?? nova_get_setting('page_description', 'Discover essential tips for traveling in Egypt, including cultural insights, safety advice, and must-visit attractions.'),
            'image' => [
                '@type' => 'ImageObject',
                'url' => $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] ?? '',
                'width' => $article->image_width ?? 1200,
                'height' => $article->image_height ?? 630
            ],
            'author' => [
                '@type' => nova_get_setting('author_type', 'Organization'),
                'name' => nova_get_setting('site_name', 'Exceptional Tours Egypt'),
                '@id' => nova_get_setting('site_url', url('/')) . '/organization'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => nova_get_setting('site_name', 'Exceptional Tours Egypt'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => Storage::url(nova_get_setting('logo', asset('assets/images/logo.png')))
                ]
            ],
            'datePublished' => $article->published_at
                ? $article->published_at->format('Y-m-d')
                : nova_get_setting('publish_date', now()->format('Y-m-d')),
            'dateModified' => $article->updated_at
                ? $article->updated_at->format('Y-m-d')
                : nova_get_setting('modified_date', now()->format('Y-m-d')),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $article->url ?? request()->url()
            ],
            'wordCount' => str_word_count(strip_tags($article->content ?? '')),
            'articleSection' => $article->category?->name ?? nova_get_setting('article_section', 'Travel Guide')
        ];

        // Return JSON-LD as a string
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }   
}
