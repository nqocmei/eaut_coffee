<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Configuration;
use Illuminate\Support\Facades\Schema;

class ConfigServiceProvider extends ServiceProvider
{
    public function getConfigs()
    {
        if (Schema::hasTable('configuration')) {
            return Configuration::all()->pluck('value', 'key');
        }

        return collect();
    }

    public function boot()
    {
        $configs = $this->getConfigs();
        config(['site' => $configs]);
        // call in view: @config('site.key')
    }


    public function register()
    {
        //
    }
}
