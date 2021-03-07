<?php

namespace App\Providers;

use App\Dao\Orders\IOrderDao;
use App\Dao\Orders\OrderDaoImpl;
use App\Dao\Products\IProductsDao;
use App\Dao\Products\ProductsDaoImpl;
use App\Services\EmailServiceImpl;
use App\Services\Interfaces\IEmailService;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IProductService;
use App\Services\OrderServiceImpl;
use App\Services\ProductServiceImpl;
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
        //Dao bindings
        $this->app->bind(IProductsDao::class,ProductsDaoImpl::class);
        $this->app->bind(IOrderDao::class,OrderDaoImpl::class);

        //Service bindings
        $this->app->bind(IProductService::class,ProductServiceImpl::class);
        $this->app->bind(IOrderService::class, OrderServiceImpl::class);
        $this->app->bind(IEmailService::class, EmailServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
