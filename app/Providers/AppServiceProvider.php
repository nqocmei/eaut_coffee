<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Admin\AdminInterface;
use App\Repositories\Admin\AdminRepository;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;

use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;

use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Categories\CategoriesInterface;

use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;

use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerInterface;

use App\Repositories\Configuration\ConfigurationInterface;
use App\Repositories\Configuration\ConfigurationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CategoriesInterface::class, CategoriesRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(BannerInterface::class, BannerRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ConfigurationInterface::class, ConfigurationRepository::class);
        }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
