<?php

namespace App\View\Composers;

use App\Models\FaqQuestion;
use Illuminate\View\View;

class FAQComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['generalFAQs'] = FaqQuestion::select(['id', 'question', 'answer', 'model_type', 'model_id'])->where('model_id', null)->whereStatus(true)->latest()->get();
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];

        foreach ($data['generalFAQs'] as $item) {
            $faqSchema['mainEntity'][] = [
                '@type' => 'Question',
                'name' => $item->question, // Adjust based on your column name (e.g., title or question)
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($item->answer) // Adjust based on your column name (e.g., description or answer)
                ]
            ];
        }

        // Convert to JSON-LD
        $data['jsonLd'] = json_encode($faqSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);        // dd($data['generalFAQs']);
        // dd($data['jsonLd']);
        $view->with($data);
    }
}
