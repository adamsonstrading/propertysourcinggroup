<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Service;

class NavigationComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Cache navigation services for 1 hour
        $services = Cache::remember('nav_services', 3600, function () {
            return Service::select('id', 'title', 'slug')->get();
        });

        $view->with('navServices', $services);
    }
}
