<?php

namespace App\Providers;

use App\Interfaces\ClientInterface;
use App\Interfaces\DeviceInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\UserInterface;
use App\Repositories\ClientRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ClientInterface::class, ClientRepository::class);
        $this->app->bind(DeviceInterface::class, DeviceRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
