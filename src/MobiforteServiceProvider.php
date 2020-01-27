<?php

namespace Nanadjei2\Mobiforte;

use Nanadjei2\Mobiforte\Mobiforte;
use Illuminate\Support\ServiceProvider;

class MobiforteServiceProvider extends ServiceProvider
{
    public function boot()
    { }

    public function register()
    { 
        $this->app->bind('mobi-forte', function() {
            return new Mobiforte();
        })
    }
}
