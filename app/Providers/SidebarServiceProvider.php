<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;
class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $page = Request::segment(1);

         view()->share('page',$page);
    }
}
