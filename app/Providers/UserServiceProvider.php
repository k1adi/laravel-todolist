<?php

namespace App\Providers;

use App\Services\Implementation\UserServiceImplementation;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// Implements DeferrableProvider agar service di load secara lazy (hanya ketika dibutuhkan)
class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserService::class => UserServiceImplementation::class,
    ];

    public function provides(): array
    {
        return [UserService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
