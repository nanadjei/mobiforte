<?php

namespace Nanadjei2\Mobiforte;

use Nanadjei2\Mobiforte\Mobiforte;
use Illuminate\Support\ServiceProvider;

class MobiforteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register()
    {
        $this->app->bind('mobi-forte', function () {
            return new Mobiforte();
        });

        /** Config File */
        $this->mergeConfigFrom(__DIR__ . "/../config/mobiforte.php", "mobiforte");
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        /**Publish vendor/nanadjei2/mobiforte-sms/config/mnotify.php */
        /** to config/mobiforte.php */
        $this->publishes([
            __DIR__ . "/../config/mobiforte.php" => config_path("mobiforte.php")
        ]);
    }
}
