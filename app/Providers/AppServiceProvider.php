<?php

namespace App\Providers;

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\LocationRepositoryInterface;
use App\Repositories\LocationRepository;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Interfaces\BannerRepositoryInterface;
use App\Repositories\BannerRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\FavoriteRepositoryInterface;
use App\Repositories\FavoriteRepository;
use App\Interfaces\ShoppingCartRepositoryInterface;
use App\Repositories\ShoppingCartRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);

        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        $this->app->bind(ShoppingCartRepositoryInterface::class, ShoppingCartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
