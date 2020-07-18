<?php

namespace App\Providers;

use App\Repositories\Impl\BaseRepository;
use App\Repositories\Impl\CategoryRepository;
use App\Repositories\Impl\ProductRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
