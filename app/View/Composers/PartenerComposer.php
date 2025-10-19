<?php

namespace App\View\Composers;

use App\Models\Partner;
use Illuminate\View\View;

class PartenerComposer
{
    public function compose(View $view)
    {
        $data = [];
        $data['partners'] = Partner::whereStatus(true)->latest()->get();
        // dd($data['partners']);
        $view->with($data);
    }
}
