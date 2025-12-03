<?php

namespace App\Providers;

use App\Interfaces\AttributeRepositoryInterface;
use App\Interfaces\AttributeValueRepositoryInterface;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\CartItemRepositoryInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\DiscountRepositoryInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AttributeRepositories;
use App\Repositories\AttributeValueRepositories;
use App\Repositories\BaseRepositories;
use App\Repositories\CartItemRepositories;
use App\Repositories\CartRepositories;
use App\Repositories\CategoryRepositories;
use App\Repositories\DiscountRepositories;
use App\Repositories\OrderItemRepositories;
use App\Repositories\OrderRepositories;
use App\Repositories\ProductRepositories;
use App\Repositories\ProductVariantRepositories;
use App\Repositories\UserRepositories;
use App\Services\Mail\MailService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MailServiceInterface::class, MailService::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepositories::class);
        $this->app->bind(BaseRepositoryInterface::class,BaseRepositories::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepositories::class);
        $this->app->bind(DiscountRepositoryInterface::class,DiscountRepositories::class);
        $this->app->bind(AttributeRepositoryInterface::class,AttributeRepositories::class);
        $this->app->bind(AttributeValueRepositoryInterface::class,AttributeValueRepositories::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepositories::class);
        $this->app->bind(ProductVariantRepositoryInterface::class,ProductVariantRepositories::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepositories::class);
        $this->app->bind(OrderItemRepositoryInterface::class,OrderItemRepositories::class);
        $this->app->bind(CartRepositoryInterface::class,CartRepositories::class);
        $this->app->bind(CartItemRepositoryInterface::class,CartItemRepositories::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
