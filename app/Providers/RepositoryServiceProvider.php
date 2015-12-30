<?php

namespace BenditaFome\Providers;

use BenditaFome\Repositories\CategoryRepository;
use BenditaFome\Repositories\CategoryRepositoryEloquent;
use BenditaFome\Repositories\ClientRepository;
use BenditaFome\Repositories\ClientRepositoryEloquent;
use BenditaFome\Repositories\CouponRepository;
use BenditaFome\Repositories\CouponRepositoryEloquent;
use BenditaFome\Repositories\ProductRepository;
use BenditaFome\Repositories\ProductRepositoryEloquent;
use BenditaFome\Repositories\UserRepository;
use BenditaFome\Repositories\UserRepositoryEloquent;
use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\OrderRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package BenditaFome\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CategoryRepository::class,
            CategoryRepositoryEloquent::class
        );

        $this->app->bind(
            ProductRepository::class,
            ProductRepositoryEloquent::class
        );

        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryEloquent::class
        );

        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );

        $this->app->bind(
            OrderRepository::class,
            OrderRepositoryEloquent::class
        );

        $this->app->bind(
            CouponRepository::class,
            CouponRepositoryEloquent::class
        );
    }
}
