<?php

namespace Myrtle\Core\Permissions\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Myrtle\Core\Permissions\Http\Middleware\CreateDefinedAbilities;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootRouteMiddleware();
    }

    protected function bootRouteMiddleware()
    {
        Route::pushMiddlewareToGroup('web', CreateDefinedAbilities::class);
    }
}
