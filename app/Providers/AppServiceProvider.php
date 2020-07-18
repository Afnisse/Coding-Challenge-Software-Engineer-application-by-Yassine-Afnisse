<?php

namespace App\Providers;

use App\Services\CategoryServiceInterface;
use App\Services\Impl\CategoryService;
use App\Services\Impl\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }
}
