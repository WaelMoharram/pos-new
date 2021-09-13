<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        Relation::requireMorphMap();

        Relation::morphMap([
            'client' => 'App\Models\Client',
            'supplier' => 'App\Models\Supplier',
            'store' => 'App\Models\Store',
        ]);
    }
}
