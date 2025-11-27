<?php

namespace App\Providers;

use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\DiscountRepositoryInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepositories;
use App\Repositories\CategoryRepositories;
use App\Repositories\DiscountRepositories;
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
